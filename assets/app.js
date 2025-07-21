import "./bootstrap.js";
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import "select2/dist/css/select2.min.css";
import "select2";

import $ from "jquery";

$(document).ready(function () {
    $(".select2").select2();
});
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap";
import "./styles/app.css";

console.log("This log comes from assets/app.js - welcome to AssetMapper! 🎉");
