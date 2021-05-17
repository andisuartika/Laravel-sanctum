import Home from "../views/Home";
import About from "../views/About";

import CreateMhs from "../views/Mahasiswa/Create";
import TableMhs from "../views/Mahasiswa/Table";
import ShowMhs from "../views/Mahasiswa/Show";
import EditMhs from "../views/Mahasiswa/Edit";

export default {
    mode: "history",
    linkActiveClass: "active",

    routes: [
        {
            path: "/",
            name: "home",
            component: Home
        },
        {
            path: "/about",
            name: "pages.about",
            component: About
        },
        {
            path: "/mahasiswa/create",
            name: "mahasiswa.create",
            component: CreateMhs
        },
        {
            path: "/mahasiswa/table",
            name: "mahasiswa.table",
            component: TableMhs
        },
        {
            path: "/mahasiswa/:mhsId",
            name: "mahasiswa.show",
            component: ShowMhs
        },
        {
            path: "/mahasiswa/:mhsId/edit",
            name: "mahasiswa.edit",
            component: EditMhs
        }
    ]
};
