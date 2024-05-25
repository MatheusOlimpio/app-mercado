import { createBrowserRouter } from "react-router-dom";
import ManageProducts from "./pages/ManageProducts";
import ManageTax from "./pages/ManageTax";
import ManageProductsType from "./pages/ManageProductsType";
import Layout from "./components/Layout/Layout";
import Home from "./pages/Home";
import SalesHistory from "./pages/SalesHistory";

const router = createBrowserRouter([
  {
    path: "/",
    element: <Layout />,
    children: [
      {
        element: <Home />,
        index: true,
      },
      {
        path: "/manage/products",
        element: <ManageProducts />,
      },
      {
        path: "/manage/tax",
        element: <ManageTax />,
      },
      {
        path: "/manage/products-type",
        element: <ManageProductsType />,
      },
      {
        path: "/manage/sales",
        element: <SalesHistory />,
      },
    ],
  },
]);

export default router;
