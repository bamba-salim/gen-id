<?php

namespace App\Http\Middleware;

use App\Http\conf\Controller;
use App\Http\Repositories\SubscriptionRepository;
use App\Utils\DateUtils;
use Closure;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckApiKeyToken extends Controller
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('api-user-token');
        if (empty($token)) return self::jsonResponse(["message" => "invalid token"], 403);

        // get key subs
        $subs = SubscriptionRepository::getSubsByApiKey($token);

        // check if api key is valid
        if ($subs->isEmpty()) return self::jsonResponse(["message" => "invalid token"], 403);

        // filter and check if filter is on
        $filtersWithDate = self::filterSubDate($subs);
        if ($filtersWithDate->count() == 0) return self::jsonResponse(["message" => "Les dates de vos abonnments ont été dépassés"], 401);
        if ($filtersWithDate->count() != 1) return self::jsonResponse(["message" => "Problème avec vos abonements veuillez contactez le service client"], 401);

        // filter and check if limit is reached
        $filtersWithsubs = self::filterSubCalls($filtersWithDate);
        if ($filtersWithsubs->isEmpty()) return self::jsonResponse(["message" => "Vous avez épuisez vos crédits d'appel, veuillez prendre un nouvel abonement"], 401);
        self::incrementSubCalls($filtersWithsubs->first()->id);

        // call controller method
        return $next($request);
    }

    /**
     * @param Collection $subs
     * @return Collection
     */
    private static function filterSubDate(Collection $subs): Collection
    {
        $now = DateUtils::date_now();

        return $subs->filter(function ($sub) use ($now) {
            $dateFin = DateUtils::formatFromDB($sub->date_fin)->addDay();
            $dateDebut = DateUtils::formatFromDB($sub->date_debut);
            return $dateDebut->lessThan($now) && $dateFin->greaterThan($now);
        });
    }

    /**
     * @param Collection $subs
     * @return Collection
     */
    private static function filterSubCalls(Collection $subs): Collection
    {
        return $subs->filter(function ($sub) {
            return $sub->limit > $sub->calls || $sub->limit === 0;
        });
    }


    /**
     * @param $id
     * @return void
     */
    private static function incrementSubCalls($id)
    {
        DB::table('subscriptions')->where('id', $id)->increment('calls');
    }
}
