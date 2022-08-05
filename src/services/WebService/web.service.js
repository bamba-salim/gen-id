import axios from "axios";
import AuthService from "../Routing/auth.service";

export const ws = axios.create({
    baseURL: `${process.env.REACT_APP_API_URL}`,
    headers: {'api-user-token': "8f7097b47a9f3a5e-b40905c39fe8903e-774e056353193794-b7d929e9ea853bb3"}

})

export default ws

export const GET = async (url, params = {}) => {
    return await ws.get(url,params)
        .then(res => {
            if (res.data.error) console.log(res.data)
            return res.data
        })
        .catch(err => console.log(err))
}

export const POST = (url, data) => {
        return ws.post(url, data)
        .then(res => {
            if (res.data.error) console.log(res.data)
            return res.data
        })
        .catch(err => console.log(err))
}

export const PUT = (url, data) => {
    return ws.put(url, {data})
        .then(res => {
            if (res.data.error) console.log(res.data)
            return res.data
        })
        .catch(err => console.log(err))

}


