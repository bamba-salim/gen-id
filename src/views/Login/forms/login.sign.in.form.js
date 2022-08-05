import React, {useState} from 'react';
import * as Yup from "yup";
import {useFormik} from "formik";
import LodashUtils from "../../../ressources/utils/lodash.utils";
import {useNavigate} from "react-router-dom";
import LoginService from "../../../services/WebService/login.service";


function LoginSignInForm() {
    const navigate = useNavigate();

    const [loginErrors, setLoginErrors] = useState([]);

    const onSubmit = values => {

        if(LodashUtils.isEmpty(loginErrors))  setLoginErrors([])
        LoginService.signIn(values).then(res => {
            console.log(res)

        })
    }
    const validationSchema = Yup.object({
        login: Yup.string().required('requis'),
        password: Yup.string().required('requis')
    })


    const formik = useFormik({
        initialValues: {login: '', password: ""},
        onSubmit,
        validationSchema
    })

    //todo: optimise form

    return (
        <>
            <h2 className="text-center my-2">Connexion</h2>
            <hr/>
            <form onSubmit={formik.handleSubmit}>
                <div className="row row-cols-1">
                    <div
                        className={`col mb-3  ${((formik.errors.login && formik.touched.login) || loginErrors.login) && 'has-error'}`}>
                        <label htmlFor="login" className="form-label">Identifiant *</label>
                        <input type="text" className="form-control" id="login" name="login" placeholder="Identifiant"
                               onChange={formik.handleChange} value={formik.values.name}
                               onBlur={formik.handleBlur}/>
                        <p>{((formik.errors.login && formik.touched.login) && formik.errors.login) || loginErrors.login}</p>
                    </div>
                    <div
                        className={`col mb-3  ${(((formik.errors.password && formik.touched.password)) || loginErrors.password) && 'has-error'}`}>
                        <label htmlFor="password" className="form-label">Mot de passe *</label>
                        <input type="password" className="form-control" id="password" name="password"
                               placeholder="Mot de passe"
                               onChange={formik.handleChange} value={formik.values.password}
                               onBlur={formik.handleBlur}/>
                        <p>{((formik.errors.password && formik.touched.password) && formik.errors.password) || loginErrors.password}</p>
                    </div>
                    <div className="col w-100 justify-content-end nav">
                        <button type="submit" className="btn btn-gold">Enregistrer</button>
                    </div>
                </div>
            </form>
        </>
    );
}

export default LoginSignInForm;
