import { Box } from "@mui/material";
import Navbar from "../Header/Navbar";
import { Outlet } from "react-router-dom";

export default function Layout() {
  return (
    <>
      <Navbar />
      <Box sx={{ flexGrow: 1, mt: 2, p: 2 }}>
        <Outlet />
      </Box>
    </>
  );
}
