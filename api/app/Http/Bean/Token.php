<?php

namespace App\Http\Bean;

use App\Utils\DataBaseConstants;
use App\Models\User;
use App\Models\UserKeyword;
use stdClass;
use Throwable;

class Token
{
    public string $type;
    public int $size;
    public string $format;
    public string $prefix;
    public string $suffix;
    public string $separator;
    // todo: add suffice & prefix separator
    public User $user;
    public TokenLogs $logs;


    /**
     * @param string $type
     * @param User $user
     * @param stdClass $options
     */
    public function __construct(string $type, User $user, stdClass $options)
    {

        $this->setLogs(new TokenLogs());
        $this->setType($type);
        $this->setSize($this->match_token_size($options->size ?? null));
        $this->setFormat($this->match_token_format($options->format ?? null));
        $this->setSeparator($this->match_token_separator($options->separator ?? '-'));

        $this->setUser($user);

        $this->setPrefix($this->check_user_keyword($options->prefix ?? '', DataBaseConstants::USER_KEYWORDS_TYPE['PREFIX']));
        $this->setSuffix($this->check_user_keyword($options->suffix ?? '', DataBaseConstants::USER_KEYWORDS_TYPE['SUFFIX']));
    }


    ########## METHODS #################################################################################################

    private function match_token_size($size): int
    {
        $this->getLogs()->setSize($size != null ? 'ok' : null);
        try {
            return DataBaseConstants::ID_TYPE_SIZE[$this->getType()][strtolower($size)];
        } catch (Throwable $e) {
            return match ($this->getType()) {
                'uid' => 6,
                'sku' => 8,
                'serial' => 3
            };
        }

    }

    private function match_token_separator($separator)
    {
        if ($separator == 'blank') return '';
        return $separator;
    }


    //todo: V2
    private function match_token_format($format)
    {
        $this->getLogs()->setFormat($format != null ? 'ok' : null);
        try {
            return strtolower($format);
        } catch (Throwable $e) {
            return "DA";
        }

    }


    protected function check_user_keyword($keyword, $keyWordsType)
    {
        $type = strtolower(array_search($keyWordsType, DataBaseConstants::USER_KEYWORDS_TYPE));

        if (empty($keyword)) {
            $this->getLogs()->{$type} = null;
            return '';
        }

        $key = UserKeyword::query()->select('user_id')
            ->where('name', '=', $keyword) // name
            ->where('user_keyword_type_id', '=', $keyWordsType) // type
            ->get()->first();

        if ($key === null) {
            $this->getLogs()->{$type} = 'ok';
            return $keyword;
        }

        if ($key->user_id !== $this->getUser()->id) {
            $this->getLogs()->{$type} = "Vous ne possédez pas le $type [$keyword] !";
            return '';
        } else {
            $this->getLogs()->{$type} = 'ok';
            return $keyword;
        }
    }

    ########## GETTERS & SETTERS #######################################################################################

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @param int $size
     */
    public function setSize(int $size): void
    {
        $this->size = $size;
    }

    /**
     * @return string
     */
    public function getFormat(): string
    {
        return $this->format;
    }

    /**
     * @param string $format
     */
    public function setFormat(string $format): void
    {
        $this->format = $format;
    }

    /**
     * @return string
     */
    public function getPrefix(): string
    {
        return $this->prefix;
    }

    /**
     * @param string $prefix
     */
    public function setPrefix(string $prefix): void
    {
        $this->prefix = $prefix;
    }

    /**
     * @return string
     */
    public function getSuffix(): string
    {
        return $this->suffix;
    }

    /**
     * @param string $suffix
     */
    public function setSuffix(string $suffix): void
    {
        $this->suffix = $suffix;
    }

    /**
     * @return TokenLogs
     */
    public function getLogs(): TokenLogs
    {
        return $this->logs;
    }

    /**
     * @param TokenLogs $logs
     */
    public function setLogs(TokenLogs $logs): void
    {
        $this->logs = $logs;
    }

    /**
     * @return string
     */
    public function getSeparator(): string
    {
        return $this->separator;
    }

    /**
     * @param string $separator
     */
    public function setSeparator(string $separator): void
    {
        $this->separator = $separator;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

}
