import {GET, POST, PUT} from "./web.service";

export default class UserService {

    static fetchAllUsers = () => GET('fetch-all-user');

    static fetchUser = (idUser) => GET(`fetch-user/${idUser}`);

    static updateUser = (userData) => POST('update-user', {userDto: userData}); // todo: a revoir

    static signIn = (userData) => POST('sign-in', userData);

    static signUp = (values) => POST('sign-up', {signUpFormBean: values});

    static deleteUser = (idUser) => PUT('delete-user', {idUser: idUser});

    static switchUserRole = (idUser, isAdmin) => POST('switch-user-role', {user : {idUser: idUser, role: isAdmin}});
}
