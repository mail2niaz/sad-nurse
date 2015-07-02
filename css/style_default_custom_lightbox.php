<?php
ob_start("ob_gzhandler");
header("Content-type: text/css; charset: UTF-8");
?>
@import url('bootstrap.min.css');
@import url('bootstrap-responsive.min.css');
@import url('jquery.ui.css');
@import url('animate.min.css');
@import url('animate.delay.css');
@import url('jquery.alerts.css');
 @import url('jquery.chosen.css');
@import url('fullcalendar.css');
@import url('font-awesome.css');
/***** RESET BROWSER STYLE *****/
/*******************************/

html, body, div, span, applet, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, a, abbr, acronym, address, big, cite, code, del, dfn, em, font, img, ins, kbd, q, s, samp, small, strike, strong, sub, sup, tt, var, b, u, i, center, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td {
	background: transparent;
	border: 0;
	margin: 0;
	padding: 0;
	vertical-align: baseline;
	line-height: 21px;
	outline: none;
}
::selection {
	background: #ccc;
	color: #fff;
	text-shadow: none;
} /* Safari */
::-moz-selection {
background: #ccc;
color: #fff;
text-shadow: none;
} /* Firefox */
:-moz-placeholder {
color: #bbb;
}
::-webkit-input-placeholder {
color: #bbb;
}
:-ms-input-placeholder {
color: #bbb;
}
a, a:link {
	color: blue;
}
h4 {
	font-size: 16px;
}
body {
	/*background: url(../images/leftpanelbg.png) repeat-y 0 0;*/
	/*background:#FFCF75;*/
	background:#fff;
	font-size: 12px;
	font-family: 'RobotoRegular', 'Helvetica Neue', Helvetica, sans-serif;
}
body.errorpage {
	background: #fff url(../images/bg1.png);
}
body.loginpage {
	/*background: #97400C;*/
	background:#fff;
}
.breadcrumb a, .breadcrumb a:hover, .breadcrumb a:link, .breadcrumb a:active, .breadcrumb a:focus {
	outline: none;
	color: #ffffff;
	text-decoration: none;
}
a, a:hover, a:link, a:active, a:focus {
	outline: none;
	color: #97400C;
	text-decoration: none;
}
a:hover {
	text-decoration: underline;
}
input, select, textarea, button {
	outline: none;
	font-size: 13px;
	font-family: 'RobotoRegular', 'Helvetica Neue', Helvetica, sans-serif;
}
strong {
	font-weight: normal;
}
label, input, textarea, select, button {
	font-size: 13px;
}
h1, h2, h3, h4, h5 {
	font-weight: normal;
	line-height: normal;
}
/*** LOGIN PAGE ***/

.loginpanel {
	position: absolute;
	top: 50%;
	left: 50%;
	height: 300px;
}
.loginpanelinner {
	position: relative;
	top: -150px;
	left: -50%;
}
.loginpanelinner .logo {
	text-align: center;
	padding: 20px 0;
}
.loginpanel .pull-right {
	margin-top: 11px;
	color: #ddd;
	font-size: 11px;
	font-family: Helvetica, sans-serif;
}
.loginpanel .pull-right a {
	color: #ddd;
}
.inputwrapper input {
	border: 0;
	padding: 10px;
	background: #fff;
	width: 250px;
}
.inputwrapper input:active, .inputwrapper input:focus {
	background: #fff;
	border: 0;
}
.inputwrapper button {
	display: block;
	border: 1px solid #97400C;
	padding: 10px;
	background: #97400C;
	width: 100%;
	color: #fff;
	text-transform: uppercase;
}
.inputwrapper button:focus, .inputwrapper button:active, .inputwrapper button:hover {
	background: #F4935A;
}
.inputwrapper label {
	display: inline-block;
	margin-top: 10px;
	color: rgba(255,255,255,0.8);
	font-size: 11px;
	vertical-align: middle;
}
.inputwrapper label input {
	width: auto;
	margin: -3px 5px 0 0;
	vertical-align: middle;
}
.inputwrapper .remember {
	padding: 0;
	background: none;
}
.login-alert {
	display: none;
}
.login-alert .alert {
	font-size: 11px;
	text-align: center;
	padding: 5px 0;
	border: 0;
}
.loginfooter {
	font-size: 11px;
	color: rgba(255,255,255,0.5);
	position: absolute;
	position: fixed;
	bottom: 0;
	left: 0;
	width: 100%;
	text-align: center;
	font-family: arial, sans-serif !important;
	padding: 5px 0;
}
/*** REGISTRATION PAGE ***/

.regpanel {
	width: 380px;
	margin: 40px auto 0 auto;
}
.regpanel .logo {
	text-align: center;
	margin-bottom: 10px;
}
.regpanel .pageheader {
	background: none;
	border-bottom: 1px solid rgba(255,255,255,0.1);
	padding: 0 0 25px 0;
}
.regpanel .pageicon {
	color: #fff;
	border-color: #fff;
}
.regpanel .pagetitle h5 {
	color: rgba(255,255,255,0.5);
}
.regpanel .pagetitle h1 {
	color: #fff;
}
.regcontent {
	padding: 10px 0;
	color: #fff;
}
.regcontent .stdform p {
	margin: 10px 0;
}
.regcontent .stdform input {
	margin: 0;
	padding: 7px 5px;
	vertical-align: middle;
	border: 0;
}
.regcontent input[type="radio"] {
	margin-right: 5px;
	display: inline-block;
}
.regcontent .bday select {
	width: auto;
	height: auto;
	padding: 5px;
	font-size: 12px;
	border: 0;
}
.regcontent h3 {
	margin: 15px 0;
	color: rgba(255,255,255,0.5);
}
.regcontent button {
	display: block;
	border: 1px solid #0c57a3;
	padding: 12px 10px;
	background: #0972dd;
	width: 100%;
	color: #fff;
	text-transform: uppercase;
}
.regfooter {
	margin: 0 auto 20px auto;
	width: 380px;
	text-align: center;
	color: rgba(255,255,255,0.5);
	font-size: 11px;
}
/*** HEADER ***/

.header {
	/*background: #97400C;*/
	/*background:#34b9e2;*/
	/*background:#FF8000;*/
	background:#F87000;
	clear: both;
	height: 115px;
}
.headerinner {
	margin-left: 260px;
}
.header .logo {
	width: 260px;
	text-align: center;
	padding-top: 25px;
	padding-left: 10px;
	float: left;
}

logo
.headmenu {
	list-style: none;
}
.headmenu .dropdown-menu {
	border: 2px solid #97400C;
	border-top: 0;
	margin: 0;
}
.headmenu .nav-header {
	text-shadow: none;
	font-weight: normal;
}
.headmenu .dropdown-menu::after {
	position: absolute;
	top: -6px;
	left: 45px;
	display: inline-block;
	border-right: 6px solid transparent;
	border-bottom: 6px solid white;
	border-left: 6px solid transparent;
	content: '';
}
.headmenu > li {
	display: inline-block;
	float: left;
	font-size: 14px;
	position: relative;
	border-right: 1px solid rgba(255,255,255,0.15);
}
.headmenu > li:first-child {
	border-left: 1px solid rgba(255,255,255,0.15);
}
.headmenu > li.odd {
	background: rgba(255,255,255,0.1);
}
.headmenu > li.right {
	float: right;
	border-right: 0;
}
.headmenu > li > a {
	min-width: 70px;
	position: relative;
	display: block;
	color: #fff;
	padding: 25px 20px 9px 20px;
	cursor: pointer;
}
.headmenu > li > a:hover {
	text-decoration: none;
}
.headmenu > li > a .count {
	position: absolute;
	top: 5px;
	right: 10px;
	opacity: 0.5;
}
.headmenu > li > a:hover .count, .headmenu > li.open > a .count {
	opacity: 1;
}
.headmenu > li > a .headmenu-label {
	display: block;
	margin: 2px 0 3px 0;
	opacity: 0.5;
	text-align: center;
}
.headmenu > li > a:hover .headmenu-label, .headmenu > li.open > a .headmenu-label {
	opacity: 1;
}
.headmenu > li > a .head-icon {
	width: 50px;
	height: 50px;
	display: block;
	margin: auto;
	opacity: 0.5;
}
.headmenu > li > a:hover .head-icon, .headmenu > li.open a .head-icon {
	opacity: 1;
}
.head-message {
	background-image: url(../images/icons/message.png);
}
.head-users {
	background-image: url(../images/icons/users.png);
}
.head-bar {
	background-image: url(../images/icons/bar.png);
}
.viewmore a {
	font-size: 11px;
	text-transform: uppercase;
	font-size: 11px !important;
}
.newusers {
	min-width: 200px;
}
.newusers li a:hover {
background;
#eee;
}
.newusers .userthumb {
	width: 35px;
	display: block;
	float: left;
	margin-right: 10px;
}
.newusers strong {
	display: block;
	line-height: normal;
}
.newusers small {
	color: #999;
	line-height: normal;
}
.userloggedinfo {
	padding: 11px;
	color: #fff;
}
.userloggedinfo img {
	padding: 3px;
	background: rgba(255,255,255,0.2);
	width: 80px;
	float: left;
}
.userloggedinfo .userinfo {
	float: left;
	margin-left: 10px;
}
.userloggedinfo .userinfo small {
	font-size: 11px;
	opacity: 0.6;
	color: #fff;
	font-family: sans-serif;
	font-style: italic;
}
.userloggedinfo ul {
	list-style: none;
	margin-top: 5px;
}
.userloggedinfo ul li {
	display: block;
	font-size: 11px;
	line-height: normal;
	margin-bottom: 1px;
}
.userloggedinfo ul li a {
	padding: 4px 5px 3px 5px;
	color: #fff;
	line-height: normal;
	background: rgba(255,255,255,0.1);
	display: block;
}
.userloggedinfo ul li a:hover {
	text-decoration: none;
	background: rgba(255,255,255,0.2);
}
.no-borderradius .userloggedinfo .userinfo {
	float: none;
	margin-left: 92px;
}
/*** LEFT PANEL ***/

.leftpanel {
	width: 260px;
	color: #fff;
	float: left;
}
.leftmenu .nav-header {
	font-weight: normal;
	font-size: 11px;
	padding: 5px 20px;
	text-shadow: none;
	/*background: #232323;*/
	background:#97400C;
	border-bottom: 1px solid #97400C;
	color:#fff !important;
}
.leftmenu .nav-tabs.nav-stacked a {
	color: #000;
	padding: 10px 20px;
	font-size: 14px;
}
.leftmenu .nav-tabs.nav-stacked a span {
	margin-right: 10px;
}
.leftmenu .nav-tabs.nav-stacked > li > a {
	border-color: #F4935A !important;
	border: 0;
	border-bottom: 1px solid #232323;
}
.leftmenu .nav-tabs.nav-stacked > li > a:hover, .leftmenu .nav-tabs.nav-stacked > li > a:focus {
	/*background-color: #2c2c2c;*/
	background-color: #F4935A;
	color: #fff;
	border-bottom-color: #232323;
}

.leftmenu .nav-tabs.nav-stacked > li ul li.active-sub{
	background-color: #F4935A;
}

.leftmenu .nav-tabs.nav-stacked > li.active > a {
	/*background-color: #97400C;*/
	/*background:#34b9e2;*/
	background:#97400C;
	color: #fff;
	border-bottom-color: rgba(0,0,0,0.2);
}
.leftmenu .nav-tabs.nav-stacked > li.active > a:hover {
	background-color: #F4935A;
}
.leftmenu .nav-tabs > li {
	margin-bottom: 0;
	color:#000;
}
.leftmenu .nav-tabs.nav-stacked > li.dropdown ul {
	background: #eee;
	display: none;
}
.leftmenu .nav-tabs.nav-stacked > li.dropdown ul li {
	border-bottom: 1px solid #ddd;
	border-right: 1px solid #ddd;
}
.leftmenu .nav-tabs.nav-stacked > li.dropdown > a {
	background-image: url(../images/droparrow.png);
	background-repeat: no-repeat;
	background-position: right 19px;
}
.leftmenu .nav-tabs.nav-stacked .dropdown ul li a {
	display: block;
	font-size: 13px;
	padding: 7px 10px 7px 50px;
	color: #333;
	background-position: 25px 12px;
	background-image: url(../images/menuarrow.png);
	background-repeat: no-repeat;
}
.leftmenu .nav-tabs.nav-stacked .dropdown ul li.active a {
	background-color: #fff;
}
.leftmenu .nav-tabs.nav-stacked .dropdown ul li a:hover {
	text-decoration: none;
	background-color: #fff;
}
.leftmenu .nav-tabs.nav-stacked .dropdown ul ul li {
	border-right: 0;
}
.leftmenu .nav-tabs.nav-stacked .dropdown ul ul li a {
	padding-left: 70px;
	background-position: 50px 12px;
}
.leftmenu .nav-tabs.nav-stacked .dropdown ul ul li:first-child a {
	border-top: 1px solid #ddd;
}
/*** MAIN PANEL ***/

.rightpanel {
	margin-left: 260px;
	background: url(../images/bg1.png);
	border-left:3px solid #97400C;
}
.rightpanel:after {
	clear: both;
	content: '';
	display: block;
}
.breadcrumb {
	list-style: none;
	height: 22px;
	/*background: #ddd;*/
	background:#97400C;
	padding: 4px 0 4px 10px;
	border-bottom: 1px solid #ccc;
	position: relative;
	color:#fff;
}
.breadcrumb > li {
	display: inline-block;
	float: left;
	margin-right: 5px;
	font-size: 11px;
	color: #666;
	color:#fff;
}
.breadcrumb > li.right {
	float: right;
	padding: 0;
	border-left: 1px solid #bbb;
	margin: -4px 0 0 0;
}
.breadcrumb > li.right .dropdown-menu a {
	font-size: 11px;
	padding: 2px 10px;
}
.breadcrumb > li.right > a {
	color: #666;
	padding: 4px 10px 5px 10px;
	display: block;
}
.breadcrumb > li.right > a:hover {
	text-decoration: none;
	background: #f7f7f7;
}
.breadcrumb > li.right.open > a {
	background: #f7f7f7;
}
.breadcrumb > li.right > a i {
	vertical-align: middle;
}
.breadcrumb > li span.separator {
	width: 5px;
	height: 9px;
	vertical-align: middle;
	display: inline-block;
	background: url(../images/bcarrow.png) no-repeat 0 0;
	margin-left: 2px;
}
.breadcrumb > li:first-child a:hover {
	text-decoration: none;
	color: #666;
}
.pageheader {
	padding: 10px;
	border-bottom: 1px solid #ddd;
	position: relative;
	min-height: 50px;
	background: #fff;
}
.pageicon {
	width: 44px;
	font-size: 42px;
	padding: 10px;
	color: #97400C;
	border: 3px solid #97400C;
	display: inline-block;
	-moz-border-radius: 50px;
	-webkit-border-radius: 50px;
	border-radius: 50px;
	float: left;
	text-align: center;
}
.pagetitle {
	/*margin-left: 90px;*/
	padding-top: 5px;
}
.pagetitle h1 {
	font-size: 32px;
	margin-left: -2px;
	/*color: #97400C;*/
	color:#FF8000;
}
.pagetitle h5 {
	text-transform: uppercase;
	font-size: 11px;
	color: #999;
}
.searchbar {
	position: absolute;
	top: 25%;
	right: 20px;
}
.searchbar input {
	width: 220px;
	padding: 8px 10px;
	background: #fff url(../images/icons/search.png) no-repeat 215px 10px;
	font-size: 12px;
}
.maincontent {
	float: left;
	width: 100%;
}
.maincontentinner {
	padding: 20px;
}
.subtitle {
	text-transform: uppercase;
	font-size: 11px;
	color: #999;
	margin-bottom: 5px;
}
.subtitle2 {
	font-size: 13px;
	text-transform: uppercase;
	color: #333;
	margin-bottom: 5px;
}
.shortcuts {
	list-style: none;
	margin-top: 20px;
	overflow: hidden;
	clear: both;
}
.shortcuts li {
	display: inline-block;
	float: left;
	margin: 0 5px 5px 0;
	position: relative;
}
.shortcuts li a {
	display: block;
	width: 130px;
	height: 150px;
	/*background: #97400C;*/
	background:#97400C;
	color: #fff;
	font-size: 16px;
}
.shortcuts li a:hover {
	background: #282828;
	text-decoration: none;
}
.shortcuts li .shortcuts-label {
	display: block;
	padding: 0 12px;
}
.shortcuts li .shortcuts-icon {
	display: block;
	width: 48px;
	height: 48px;
	padding: 30px 0 20px 0;
	margin: 0 auto;
}
.shortcuts li .iconsi-event {
	background: url(../images/icons/icon-event.png) no-repeat center center;
}
.shortcuts li .iconsi-cart {
	background: url(../images/icons/icon-cart.png) no-repeat center center;
}
.shortcuts li .iconsi-archive {
	background: url(../images/icons/icon-archive.png) no-repeat center center;
}
.shortcuts li .iconsi-help {
	background: url(../images/icons/icon-help.png) no-repeat center center;
}
.shortcuts li .iconsi-images {
	background: url(../images/icons/icon-images.png) no-repeat center center;
}
.widget {
	-moz-box-shadow: 1px 1px 8px rgba(0,0,0,0.3);
	-webkit-box-shadow: 1px 1px 8px rgba(0,0,0,0.3);
	box-shadow: 1px 1px 8px rgba(0,0,0,0.3);
}
.widgettitle {
	background: #97400C;
	color: #fff;
	padding: 12px 15px;
	font-size: 14px;
}
.widgettitle span {
	vertical-align: middle;
	display: inline-block;
	margin-right: 8px;
}
.widgetcontent {
	background: #fff;
	padding: 20px 12px;
	border: 2px solid #97400C;
	border-top: 0;
	margin-bottom: 20px;
}
.widgetcontent p {
	margin: 15px 0;
}
.wt1 {
	background: #333;
	color: #fff;
}
.wc1 {
	border-color: #333;
}
/*** DASHBOARD ***/

.commentlist {
	list-style: none;
	clear: both;
}
.commentlist li {
	display: block;
	border-bottom: 1px solid #ddd;
	padding: 15px;
}
.commentlist li img {
	width: 60px;
}
.commentlist li .comment-info {
	margin-left: 80px;
}
.commentlist li p:last-child {
	margin-bottom: 0;
}
.commentlist li .btn {
	margin-right: 3px;
}
.commentlist li .btn span {
	margin-right: 5px;
}
.tabtitle {
	padding: 10px;
	font-size: 11px;
	text-transform: uppercase;
	font-weight: bold;
	font-family: sans-serif;
	margin-top: 5px;
	border-bottom: 1px solid #ddd;
}
.userlist {
	list-style: none;
}
.userlist li {
	display: block;
	border-bottom: 1px solid #ddd;
	padding: 10px;
	cursor: pointer;
}
.userlist li:hover {
	background-color: #f7f7f7;
}
.userlist li:last-child {
	border-bottom: 0;
}
.userlist li .uinfo {
	margin-left: 60px;
}
.userlist li img {
	display: block;
	width: 50px;
}
.userlist li .uinfo h5 {
	font-size: 14px;
	color: #97400C;
	margin-bottom: 2px;
}
.userlist li .uinfo span {
	display: block;
	font-size: 11px;
	line-height: 16px;
	color: #999;
}
.userlist li .uinfo span.pos {
	text-transform: uppercase;
	color: #666;
}
.userlist li .par {
	font-size: 11px;
	line-height: normal;
	margin-top: 4px;
}
.userlist-favorites li {
	cursor: default;
}
.userlist-favorites li:hover {
	background: none;
}
.userlist-favorites li .link {
	font-size: 11px;
	margin-top: 7px;
}
.userlist-favorites li .link a {
	color: #666;
	display: inline-block;
	padding: 4px 5px;
	line-height: normal;
}
.userlist-favorites li .link a:last-child {
	background: #86c91d;
	color: #fff;
}
.userlist-favorites li .link a:first-child {
	background: #e9c72a;
	color: #fff;
}
.userlist-favorites li .link a:hover {
	text-decoration: none;
	color: #fff;
}
/*** HEADERS AND BOXES ***/

.title-danger {
	background-color: #dd0000 !important;
}
.title-warning {
	background-color: #FCB904 !important;
}
.title-success {
	background-color: #86D628 !important;
}
.title-info {
	background-color: #71B8EE !important;
}
.title-inverse {
	background-color: #333 !important;
}
.headtitle {
	margin-bottom: 21px;
}
.headtitle-box {
	margin-bottom: 0;
}
.headtitle .btn-group {
	float: right;
}
.headtitle .btn-group .btn, .headtitle .btn-group .btn:focus, .headtitle .btn-group.open .btn.dropdown-toggle {
	background: none;
	border: 0;
	border-left: 1px solid rgba(255,255,255,0.2);
	color: #fff;
	padding: 11px 20px;
}
.headtitle .dropdown-menu {
	left: auto;
	right: 0;
}
.headtitle .btn-group .btn .caret {
	border-top: 4px solid #fff;
}
.widgetbox .headtitle {
	margin-bottom: 0;
}
.box-danger .widgettitle {
	background-color: #dd0000;
}
.box-danger .widgetcontent {
	border-color: #dd0000;
}
.box-warning .widgettitle {
	background-color: #FCB904;
}
.box-warning .widgetcontent {
	border-color: #FCB904;
}
.box-success .widgettitle {
	background-color: #86D628;
}
.box-success .widgetcontent {
	border-color: #86D628;
}
.box-info .widgettitle {
	background-color: #71B8EE;
}
.box-info .widgetcontent {
	border-color: #71B8EE;
}
.box-inverse .widgettitle {
	background-color: #97400C;
}
.box-inverse .widgetcontent {
	border-color: #97400C;
}
.minimize {
	width: 15px;
	height: 19px;
	display: block;
	color: #000;
	font-size: 22px;
	float: right;
	text-align: center;
	margin-right: 10px;
	cursor: pointer;
	opacity: 0.2;
	text-shadow: 1px 1px rgba(255,255,255,0.3);
}
.minimize.collapsed {
	font-size: 20px;
}
.minimize:hover {
	color: #333;
	opacity: 0.7;
	text-decoration: none;
}
/*** FORM STYLES ***/

.stdform input {
	padding: 5px;
	border: 1px solid #bbb;
}
.stdform textarea {
	padding: 6px 5px;
	border: 1px solid #bbb;
}
.stdform select {
	border: 1px solid #bbb;
	padding: 5px 2px;
}
.stdform p, .stdform div.par {
	margin: 20px 0;
}
.stdform span.field, .stdform div.field {
	margin-left: 220px;
	display: block;
	position: relative;
}
.stdform .formwrapper {
	display: block;
	padding-top: 5px;
	margin-left: 220px;
	line-height: 25px;
}
.stdform label {
	float: left;
	width: 200px;
	text-align: right;
	padding: 5px 20px 0 0;
}
.stdform label.error {
	float: none;
	display: block;
	font-size: 11px;
	color: #ff0000;
	text-align: left;
	padding: 0;
	width: auto;
	margin-left: 220px;
}
.stdform label.valid {
	color: #468847;
}
.stdform small.desc {
	font-size: 11px;
	color: #999;
	font-style: italic;
	display: block;
	margin: 5px 0 0 220px;
}
.stdform .stdformbutton {
	margin-left: 220px;
}
.stdform #spinner.input-small {
	width: 100px;
}
.stdform2 p, .stdform2 div.par {
	border-top: 1px solid #ddd;
	background: #fcfcfc;
	margin: 0;
	clear: both;
}
.stdform2 div.terms {
	border: 0;
	background: none;
}
.stdform2 p:first-child, .stdform2 div.par:first-child {
	border-top: 0;
}
.stdform2 label {
	display: inline-block;
	padding: 15px 0 0 15px;
	vertical-align: top;
	text-align: left;
	font-weight: bold;
}
.stdform2 label.error {
	margin-left: 0;
	padding: 0;
}
.stdform2 label small {
	font-size: 11px;
	color: #999;
	display: block;
	font-weight: normal;
	line-height: 16px;
}
.stdform2 span.field, .stdform2 div.field {
	margin-left: 220px;
	display: block;
	background: #fff;
	padding: 15px;
	border-left: 1px solid #ddd;
}
.stdform2 .stdformbutton {
	margin-left: 0;
	padding: 15px;
	background: #fff;
}
.stdform2 input {
	margin: 0;
}
.stdform2 input[type=checkbox], .stdform2 input[type=radio] {
	margin: 10px;
}
.dualselect {
	margin-left: 220px;
	display: block;
}
.dualselect select {
	height: 200px;
	width: 40%;
	padding: 0;
	outline: none;
}
.dualselect select option {
	padding: 4px 5px;
	margin: 0;
}
.dualselect .ds_arrow {
	display: inline-block;
	vertical-align: top;
	padding-top: 60px;
	margin: 0 10px;
}
.dualselect .ds_arrow button {
	margin-top: -1px;
}
.counter {
	display: block;
	font-size: 11px;
}
.warning {
	color: #bb0000;
}
.exceeded {
	color: #ff0000;
}
.fileupload .btn, .fileupload .fileupload-exists {
	margin: 0;
	height: 21px;
	padding: 3px 10px 4px 10px;
	border-left: 0;
}


/*** BUTTONS & ICONS ***/

[class^="iconsweets-"], [class*=" iconsweets-"] {
 display: inline-block;
 width: 16px;
 height: 16px;
 vertical-align: middle;
 background-image: url(../images/iconsweets-icons.png);
 background-position: -16px -16px;
 background-repeat: no-repeat;
}

/* White icons with optional class or on hover/active states of certain elements */
.iconsweets-white, .nav-pills > .active > a > [class^="iconsweets-"], .nav-pills > .active > a > [class*=" iconsweets-"], .nav-list > .active > a > [class^="iconsweets-"], .nav-list > .active > a > [class*=" iconsweets-"], .navbar-inverse .nav > .active > a > [class^="iconsweets-"], .navbar-inverse .nav > .active > a > [class*=" iconsweets-"], .dropdown-menu > li > a:hover > [class^="iconsweets-"], .dropdown-menu > li > a:hover > [class*=" iconsweets-"], .dropdown-menu > .active > a > [class^="iconsweets-"], .dropdown-menu > .active > a > [class*=" iconsweets-"], .dropdown-submenu:hover > a > [class^="iconsweets-"], .dropdown-submenu:hover > a > [class*=" iconsweets-"] {
 background-image: url(../images/iconsweets-icons-white.png);
}
.iconsweets-magnifying-glass {
	background-position: -16px -16px;
}
.iconsweets-trashcan {
	background-position: -48px -16px;
}
.iconsweets--trashcan2 {
	background-position: -80px -16px;
}
.iconsweets-presentation {
	background-position: -112px -16px;
}
.iconsweets-download {
	background-position: -144px -16px;
}
.iconsweets-download2 {
	background-position: -176px -16px;
}
.iconsweets-upload {
	background-position: -208px -16px;
}
.iconsweets-flag {
	background-position: -240px -16px;
}
.iconsweets-flag2 {
	background-position: -272px -16px;
}
.iconsweets-finish-flag {
	background-position: -304px -16px;
}
.iconsweets-podium {
	background-position: -16px -48px;
}
.iconsweets-cup {
	background-position: -48px -48px;
}
.iconsweets-home {
	background-position: -80px -48px;
}
.iconsweets-home2 {
	background-position: -112px -48px;
}
.iconsweets-link {
	background-position: -144px -48px;
}
.iconsweets-link2 {
	background-position: -176px -48px;
}
.iconsweets-notebook {
	background-position: -208px -48px;
}
.iconsweets-book {
	background-position: -240px -48px;
}
.iconsweets-book-large {
	background-position: -272px -48px;
}
.iconsweets-books {
	background-position: -304px -48px;
}
.iconsweets-tree {
	background-position: -16px -80px;
}
.iconsweets-construction {
	background-position: -48px -80px;
}
.iconsweets-umbrella {
	background-position: -80px -80px;
}
.iconsweets-mail {
	background-position: -112px -80px;
}
.iconsweets-help {
	background-position: -144px -80px;
}
.iconsweets-rss {
	background-position: -176px -80px;
}
.iconsweets-strategy {
	background-position: -208px -80px;
}
.iconsweets-strategy2 {
	background-position: -240px -80px;
}
.iconsweets-apartment {
	background-position: -272px -80px;
}
.iconsweets-companies {
	background-position: -304px -80px;
}
.iconsweets-ghost {
	background-position: -16px -112px;
}
.iconsweets-pacman {
	background-position: -48px -112px;
}
.iconsweets-vault {
	background-position: -80px -112px;
}
.iconsweets-archive {
	background-position: -112px -112px;
}
.iconsweets-cabinet {
	background-position: -144px -112px;
}
.iconsweets-bandaid {
	background-position: -176px -112px;
}
.iconsweets-postcard {
	background-position: -208px -112px;
}
.iconsweets-alert {
	background-position: -240px -112px;
}
.iconsweets-alert2 {
	background-position: -272px -112px;
}
.iconsweets-alarm {
	background-position: -304px -112px;
}
.iconsweets-alarm2 {
	background-position: -16px -144px;
}
.iconsweets-robot {
	background-position: -48px -144px;
}
.iconsweets-globe {
	background-position: -80px -144px;
}
.iconsweets-globe2 {
	background-position: -112px -144px;
}
.iconsweets-chemical {
	background-position: -144px -144px;
}
.iconsweets-lightbulb {
	background-position: -176px -144px;
}
.iconsweets-cloud {
	background-position: -208px -144px;
}
.iconsweets-cloud-upload {
	background-position: -240px -144px;
}
.iconsweets-cloud-download {
	background-position: -272px -144px;
}
.iconsweets-lamp {
	background-position: -304px -144px;
}
.iconsweets-preview {
	background-position: -16px -176px;
}
.iconsweets-icecream {
	background-position: -48px -176px;
}
.iconsweets-icecream2 {
	background-position: -80px -176px;
}
.iconsweets-paperclip {
	background-position: -112px -176px;
}
.iconsweets-footprints {
	background-position: -144px -176px;
}
.iconsweets-firefox {
	background-position: -176px -176px;
}
.iconsweets-chrome {
	background-position: -208px -176px;
}
.iconsweets-safari {
	background-position: -240px -176px;
}
.iconsweets-loadingbar {
	background-position: -272px -176px;
}
.iconsweets-bullseye {
	background-position: -304px -176px;
}
.iconsweets-folder {
	background-position: -16px -208px;
}
.iconsweets-locked {
	background-position: -48px -208px;
}
.iconsweets-locked2 {
	background-position: -80px -208px;
}
.iconsweets-unlock {
	background-position: -112px -208px;
}
.iconsweets-tag {
	background-position: -144px -208px;
}
.iconsweets-tag2 {
	background-position: -176px -208px;
}
.iconsweets-mac {
	background-position: -208px -208px;
}
.iconsweets-windows {
	background-position: -240px -208px;
}
.iconsweets-linux {
	background-position: -272px -208px;
}
.iconsweets-create {
	background-position: -304px -208px;
}
.iconsweets-expose {
	background-position: -16px -240px;
}
.iconsweets-key {
	background-position: -48px -240px;
}
.iconsweets-key2 {
	background-position: -80px -240px;
}
.iconsweets-table {
	background-position: -112px -240px;
}
.iconsweets-chair {
	background-position: -144px -240px;
}
.iconsweets-denied {
	background-position: -176px -240px;
}
.iconsweets-ballons {
	background-position: -208px -240px;
}
.iconsweets-cat {
	background-position: -240px -240px;
}
.iconsweets-airplane {
	background-position: -272px -240px;
}
.iconsweets-track {
	background-position: -304px -240px;
}
.iconsweets-car {
	background-position: -16px -272px;
}
.iconsweets-info {
	background-position: -48px -272px;
}
.iconsweets-alarmclock {
	background-position: -80px -272px;
}
.iconsweets-stopwatch {
	background-position: -112px -272px;
}
.iconsweets-timer {
	background-position: -144px -272px;
}
.iconsweets-clock {
	background-position: -176px -272px;
}
.iconsweets-day {
	background-position: -208px -272px;
}
.iconsweets-month {
	background-position: -240px -272px;
}
.iconsweets-dress {
	background-position: -272px -272px;
}
.iconsweets-tshirt {
	background-position: -304px -272px;
}
.iconsweets-sportshirt {
	background-position: -16px -304px;
}
.iconsweets-sweater {
	background-position: -48px -304px;
}
.iconsweets-sleeveless {
	background-position: -80px -304px;
}
.iconsweets-pants {
	background-position: -112px -304px;
}
.iconsweets-socks {
	background-position: -144px -304px;
}
.iconsweets-trolly {
	background-position: -176px -304px;
}
.iconsweets-medical {
	background-position: -208px -304px;
}
.iconsweets-suitcase {
	background-position: -240px -304px;
}
.iconsweets-suitcase2 {
	background-position: -272px -304px;
}
.iconsweets-suitcase3 {
	background-position: -304px -304px;
}
.iconsweets-shoppingbag {
	background-position: -16px -336px;
}
.iconsweets-purse {
	background-position: -48px -336px;
}
.iconsweets-bag {
	background-position: -80px -336px;
}
.iconsweets-paypal {
	background-position: -112px -336px;
}
.iconsweets-paypal2 {
	background-position: -144px -336px;
}
.iconsweets-paypal3 {
	background-position: -176px -336px;
}
.iconsweets-money {
	background-position: -208px -336px;
}
.iconsweets-money2 {
	background-position: -240px -336px;
}
.iconsweets-pricetag {
	background-position: -272px -336px;
}
.iconsweets-pricetags {
	background-position: -304px -336px;
}
.iconsweets-piggybank {
	background-position: -16px -368px;
}
.iconsweets-lemonade {
	background-position: -48px -368px;
}
.iconsweets-basket {
	background-position: -80px -368px;
}
.iconsweets-basket2 {
	background-position: -112px -368px;
}
.iconsweets-scan {
	background-position: -144px -368px;
}
.iconsweets-cart {
	background-position: -176px -368px;
}
.iconsweets-cart2 {
	background-position: -208px -368px;
}
.iconsweets-cart3 {
	background-position: -240px -368px;
}
.iconsweets-cart4 {
	background-position: -272px -368px;
}
.iconsweets-digg {
	background-position: -304px -368px;
}
.iconsweets-digg2 {
	background-position: -16px -400px;
}
.iconsweets-buzz {
	background-position: -48px -400px;
}
.iconsweets-delicious {
	background-position: -80px -400px;
}
.iconsweets-twitter {
	background-position: -112px -400px;
}
.iconsweets-twitter2 {
	background-position: -144px -400px;
}
.iconsweets-tumblr {
	background-position: -176px -400px;
}
.iconsweets-plixi {
	background-position: -208px -400px;
}
.iconsweets-dribbble {
	background-position: -240px -400px;
}
.iconsweets-dribbble2 {
	background-position: -272px -400px;
}
.iconsweets-stumbleupon {
	background-position: -304px -400px;
}
.iconsweets-lastfm {
	background-position: -16px -432px;
}
.iconsweets-mobypicture {
	background-position: -48px -432px;
}
.iconsweets-youtube {
	background-position: -80px -432px;
}
.iconsweets-youtube2 {
	background-position: -112px -432px;
}
.iconsweets-vimeo {
	background-position: -144px -432px;
}
.iconsweets-vimeo2 {
	background-position: -176px -432px;
}
.iconsweets-skype {
	background-position: -208px -432px;
}
.iconsweets-facebook {
	background-position: -240px -432px;
}
.iconsweets-like {
	background-position: -272px -432px;
}
.iconsweets-ichat {
	background-position: -304px -432px;
}
.iconsweets-myspace {
	background-position: -16px -464px;
}
.iconsweets-dropbox {
	background-position: -48px -464px;
}
.iconsweets-walking {
	background-position: -80px -464px;
}
.iconsweets-running {
	background-position: -112px -464px;
}
.iconsweets-exit {
	background-position: -144px -464px;
}
.iconsweets-male {
	background-position: -176px -464px;
}
.iconsweets-female {
	background-position: -208px -464px;
}
.iconsweets-user {
	background-position: -240px -464px;
}
.iconsweets-users {
	background-position: -272px -464px;
}
.iconsweets-admin {
	background-position: -304px -464px;
}
.iconsweets-malesymbol {
	background-position: -16px -496px;
}
.iconsweets-femalesymbol {
	background-position: -48px -496px;
}
.iconsweets-user2 {
	background-position: -80px -496px;
}
.iconsweets-users2 {
	background-position: -112px -496px;
}
.iconsweets-admin2 {
	background-position: -144px -496px;
}
.iconsweets-usercomment {
	background-position: -176px -496px;
}
.iconsweets-cog {
	background-position: -208px -496px;
}
.iconsweets-cog2 {
	background-position: -240px -496px;
}
.iconsweets-cog3 {
	background-position: -272px -496px;
}
.iconsweets-cog4 {
	background-position: -304px -496px;
}
.iconsweets-settings {
	background-position: -16px -528px;
}
.iconsweets-settings2 {
	background-position: -48px -528px;
}
.iconsweets-hd {
	background-position: -80px -528px;
}
.iconsweets-hd2 {
	background-position: -112px -528px;
}
.iconsweets-hd3 {
	background-position: -144px -528px;
}
.iconsweets-sd {
	background-position: -176px -528px;
}
.iconsweets-sd2 {
	background-position: -208px -528px;
}
.iconsweets-sd3 {
	background-position: -240px -528px;
}
.iconsweets-dvd {
	background-position: -272px -528px;
}
.iconsweets-blueray {
	background-position: -304px -528px;
}
.iconsweets-record {
	background-position: -16px -560px;
}
.iconsweets-cd {
	background-position: -48px -560px;
}
.iconsweets-cassette {
	background-position: -80px -560px;
}
.iconsweets-image {
	background-position: -112px -560px;
}
.iconsweets-image2 {
	background-position: -144px -560px;
}
.iconsweets-image3 {
	background-position: -176px -560px;
}
.iconsweets-image4 {
	background-position: -208px -560px;
}
.iconsweets-sound {
	background-position: -240px -560px;
}
.iconsweets-megaphone {
	background-position: -272px -560px;
}
.iconsweets-film {
	background-position: -304px -560px;
}
.iconsweets-film2 {
	background-position: -16px -592px;
}
.iconsweets-headphone {
	background-position: -48px -592px;
}
.iconsweets-microphone {
	background-position: -80px -592px;
}
.iconsweets-printer {
	background-position: -112px -592px;
}
.iconsweets-radio {
	background-position: -144px -592px;
}
.iconsweets-television {
	background-position: -176px -592px;
}
.iconsweets-imac {
	background-position: -208px -592px;
}
.iconsweets-laptop {
	background-position: -240px -592px;
}
.iconsweets-mightymouse {
	background-position: -272px -592px;
}
.iconsweets-magicmouse {
	background-position: -304px -592px;
}
.iconsweets-mousewire {
	background-position: -16px -624px;
}
.iconsweets-camera {
	background-position: -48px -624px;
}
.iconsweets-camera2 {
	background-position: -80px -624px;
}
.iconsweets-monitor {
	background-position: -112px -624px;
}
.iconsweets-ipod {
	background-position: -144px -624px;
}
.iconsweets-ipodnano {
	background-position: -176px -624px;
}
.iconsweets-ipad {
	background-position: -208px -624px;
}
.iconsweets-filmcamera {
	background-position: -240px -624px;
}
.iconsweets-calculator {
	background-position: -272px -624px;
}
.iconsweets-cashregister {
	background-position: -304px -624px;
}
.iconsweets-fax {
	background-position: -16px -656px;
}
.iconsweets-frames {
	background-position: -48px -656px;
}
.iconsweets-coverflow {
	background-position: -80px -656px;
}
.iconsweets-list {
	background-position: -112px -656px;
}
.iconsweets-list2 {
	background-position: -144px -656px;
}
.iconsweets-list3 {
	background-position: -176px -656px;
}
.iconsweets-list4 {
	background-position: -208px -656px;
}
.iconsweets-wordpress {
	background-position: -240px -656px;
}
.iconsweets-wordpress2 {
	background-position: -272px -656px;
}
.iconsweets-joomla {
	background-position: -304px -656px;
}
.iconsweets-expressionengine {
	background-position: -16px -688px;
}
.iconsweets-drupal {
	background-position: -48px -688px;
}
.iconsweets-arrowright {
	background-position: -80px -688px;
}
.iconsweets-arrowleft {
	background-position: -112px -688px;
}
.iconsweets-arrowdown {
	background-position: -144px -688px;
}
.iconsweets-arrowup {
	background-position: -176px -688px;
}
.iconsweets-refresh {
	background-position: -208px -688px;
}
.iconsweets-refresh2 {
	background-position: -240px -688px;
}
.iconsweets-repeat {
	background-position: -272px -688px;
}
.iconsweets-shuffle {
	background-position: -304px -688px;
}
.iconsweets-refresh3 {
	background-position: -16px -720px;
}
.iconsweets-refresh4 {
	background-position: -48px -720px;
}
.iconsweets-recycle {
	background-position: -80px -720px;
}
.iconsweets-fullscreen {
	background-position: -112px -720px;
}
.iconsweets-fitscreen {
	background-position: -144px -720px;
}
.iconsweets-origscreen {
	background-position: -176px -720px;
}
.iconsweets-bluetooth {
	background-position: -208px -720px;
}
.iconsweets-bluetooth2 {
	background-position: -240px -720px;
}
.iconsweets-wifi {
	background-position: -272px -720px;
}
.iconsweets-wifi2 {
	background-position: -304px -720px;
}
.iconsweets-iphone3 {
	background-position: -16px -752px;
}
.iconsweets-iphone4 {
	background-position: -48px -752px;
}
.iconsweets-blackberry {
	background-position: -80px -752px;
}
.iconsweets-android {
	background-position: -112px -752px;
}
.iconsweets-mobile {
	background-position: -144px -752px;
}
.iconsweets-inbox {
	background-position: -176px -752px;
}
.iconsweets-outgoing {
	background-position: -208px -752px;
}
.iconsweets-incoming {
	background-position: -240px -752px;
}
.iconsweets-speech {
	background-position: -272px -752px;
}
.iconsweets-speech2 {
	background-position: -304px -752px;
}
.iconsweets-speech3 {
	background-position: -16px -784px;
}
.iconsweets-speech4 {
	background-position: -48px -784px;
}
.iconsweets-phone {
	background-position: -80px -784px;
}
.iconsweets-phone2 {
	background-position: -112px -784px;
}
.iconsweets-battery {
	background-position: -144px -784px;
}
.iconsweets-battery2 {
	background-position: -176px -784px;
}
.iconsweets-battery3 {
	background-position: -208px -784px;
}
.iconsweets-battery4 {
	background-position: -240px -784px;
}
.iconsweets-batteryfull {
	background-position: -272px -784px;
}
.iconsweets-power {
	background-position: -304px -784px;
}
.iconsweets-electric {
	background-position: -16px -816px;
}
.iconsweets-plug {
	background-position: -48px -816px;
}
.iconsweets-brush {
	background-position: -80px -816px;
}
.iconsweets-brush2 {
	background-position: -112px -816px;
}
.iconsweets-pen {
	background-position: -144px -816px;
}
.iconsweets-bigbrush {
	background-position: -176px -816px;
}
.iconsweets-pencil {
	background-position: -208px -816px;
}
.iconsweets-clipboard {
	background-position: -240px -816px;
}
.iconsweets-scissor {
	background-position: -272px -816px;
}
.iconsweets-eyedrop {
	background-position: -304px -816px;
}
.iconsweets-abacus {
	background-position: -16px -848px;
}
.iconsweets-ruler {
	background-position: -48px -848px;
}
.iconsweets-ruler2 {
	background-position: -80px -848px;
}
.iconsweets-map {
	background-position: -112px -848px;
}
.iconsweets-maps {
	background-position: -144px -848px;
}
.iconsweets-post {
	background-position: -176px -848px;
}
.iconsweets-marker {
	background-position: -208px -848px;
}
.iconsweets-document {
	background-position: -240px -848px;
}
.iconsweets-documents {
	background-position: -272px -848px;
}
.iconsweets-pdf {
	background-position: -304px -848px;
}
.iconsweets-pdf2 {
	background-position: -16px -880px;
}
.iconsweets-word {
	background-position: -48px -880px;
}
.iconsweets-word2 {
	background-position: -80px -880px;
}
.iconsweets-word3 {
	background-position: -112px -880px;
}
.iconsweets-zip {
	background-position: -144px -880px;
}
.iconsweets-zip2 {
	background-position: -176px -880px;
}
.iconsweets-ppt {
	background-position: -208px -880px;
}
.iconsweets-ppt2 {
	background-position: -240px -880px;
}
.iconsweets-excel {
	background-position: -272px -880px;
}
.iconsweets-excel2 {
	background-position: -304px -880px;
}
.iconsweets-vcard {
	background-position: -16px -912px;
}
.iconsweets-vcard2 {
	background-position: -48px -912px;
}
.iconsweets-address {
	background-position: -80px -912px;
}
.iconsweets-chart {
	background-position: -112px -912px;
}
.iconsweets-chart2 {
	background-position: -144px -912px;
}
.iconsweets-chart3 {
	background-position: -176px -912px;
}
.iconsweets-chart4 {
	background-position: -208px -912px;
}
.iconsweets-chart5 {
	background-position: -240px -912px;
}
.iconsweets-chart6 {
	background-position: -272px -912px;
}
.iconsweets-chart7 {
	background-position: -304px -912px;
}
.iconsweets-chart8 {
	background-position: -16px -944px;
}
.glyphicons {
	list-style: none;
}
.glyphicons li {
	float: left;
	line-height: 25px;
	width: 25%;
}
.fontawesomeicons ul {
	list-style: none;
}
.fontawesomeicons ul li {
	line-height: 25px;
}
.iconsweetslist {
	list-style: none;
}
.iconsweetslist li {
	float: left;
	line-height: 26px;
	width: 25%;
}
/*** CONTENT SLIDER ***/

.bx-wrapper {
	border: 1px solid #ddd;
	width: auto !important;
	line-height: 21px;
	overflow: hidden;
}
.bx-wrapper .pager {
	margin: 0;
}
.slide_wrap {
	padding: 20px 50px;
	min-height: 60px;
}
.bx-prev {
	position: absolute;
	top: 0;
	left: 0;
	width: 30px;
	height: 100%;
	opacity: 0.6;
	vertical-align: middle;
	background: #eee url(../images/prev.png) no-repeat center center;
	border-right: 1px solid #ddd;
}
.bx-next {
	position: absolute;
	top: 0;
	right: 0;
	width: 30px;
	height: 100%;
	opacity: 0.6;
	vertical-align: middle;
	background: #eee url(../images/next.png) no-repeat center center;
	border-left: 1px solid #ddd;
}
.bx-prev:hover, .bx-next:hover {
	opacity: 1;
}
.slide_img {
	float: left;
	width: 100px;
}
.slide_content {
	margin-left: 120px;
	text-align: left;
}
.slide_content h4 {
	font-size: 18px;
	font-weight: normal;
}
.slide_content h4 a:hover {
	color: #333;
	text-decoration: none;
}
.slide_content p {
	margin: 10px 0;
}
/*** SLIM SCROLL ***/

.slimScrollDiv {
	border: 1px solid #ddd;
}
.entrylist li {
	display: block;
	padding: 20px;
	border-bottom: 1px solid #ddd;
}
.entrylist li.even {
	background: #fcfcfc;
}
.entry_wrap {
	min-height: 60px;
}
.entry_img {
	float: left;
}
.entry_content {
	margin-left: 120px;
}
.entry_content h4 {
	font-size: 18px;
	font-weight: normal;
}
.entry_content h4 a:hover {
	color: #333;
	text-decoration: none;
}
.entry_content p {
	margin: 10px 0;
}
.entry_content p:last-child {
	margin-bottom: 0;
}
/*** MEDIA STYLES ***/

.mediamgr {
	position: relative;
	min-height: 400px;
}
.mediamgr .mediamgr_right {
	position: absolute;
	width: 250px;
	top: 62px;
	right: 0;
}
.mediamgr .mediamgr_rightinner {
	margin: 20px 0;
	padding-left: 20px;
}
.mediamgr .mediamgr_rightinner h4 {
	font-size: 12px;
	text-transform: uppercase;
	padding: 10px;
	background: #97400C;
	color: #fff;
}
.mediamgr_head {
	padding: 10px;
	background: #fcfcfc;
	border: 1px solid #ccc;
	overflow: visible;
	margin-bottom: 20px;
}
.mediamgr_menu {
	list-style: none;
	position: relative;
	overflow: hidden;
}
.mediamgr_menu li {
	display: inline-block;
	float: left;
}
.mediamgr_menu li.right {
	float: right;
}
.mediamgr_menu li a {
	margin-bottom: 0;
}
.mediamgr_menu li a:hover {
	cursor: pointer;
	text-decoration: none;
}
.mediamgr_menu li a.prev {
	border-right: 0;
}
.mediamgr_menu li a.prev_disabled {
	opacity: 0.6;
}
.mediamgr_menu li a.preview_disabled {
	opacity: 0.6;
}
.mediamgr_menu form input.filekeyword {
	padding: 5px 7px;
	width: 200px;
	background: #fff;
	color: #999;
	margin: 0;
	font-style: italic;
}
.mediamgr_content {
	padding: 20px 0;
	margin-right: 250px;
}
.mediamgr_category {
	padding: 10px 0;
	border-bottom: 1px dashed #ddd;
	margin-right: 270px;
}
.mediamgr_category ul {
	list-style: none;
}
.mediamgr_category ul li {
	display: inline-block;
	margin-right: 5px;
}
.mediamgr_category ul li.right {
	float: right;
}
.mediamgr_category ul li a {
	display: block;
	padding: 3px 10px;
	color: #666;
}
.mediamgr_category ul li a:hover, .mediamgr_category ul li.current a {
	background: #333;
	color: #fff;
	text-decoration: none;
}
.mediamgr_category ul li .pagenuminfo {
	display: inline-block;
	margin-top: 5px;
}
.mediamgr_menu li a.newfilebutton {
	display: block;
	padding: 4px 10px 5px 10px;
	text-align: center;
	border: 1px solid #F0882C;
	background: #FB9337;
	color: #fff;
	font-weight: bold;
	font-size: 12px;
	-moz-box-shadow: inset 0 1px 0 rgba(250,250,250,0.3);
	-webkit-box-shadow: inset 0 1px 0 rgba(250,250,250,0.3);
	box-shadow: inset 0 1px 0 rgba(250,250,250,0.3);
}
.mediamgr_menu li a.newfilebutton:hover {
	background: #485B79;
	border: 1px solid #3f526f;
}
.menuright {
	list-style: none;
}
.menuright li {
	display: block;
	margin-bottom: 1px;
}
.menuright li a {
	display: block;
	padding: 5px 10px;
	color: #666;
}
.menuright li a:hover {
	background: #ddd;
	text-decoration: none;
}
.menuright li.current a {
	background: #333;
	color: #fff;
}
.listfile {
	list-style: none;
}
.listfile li {
	display: inline-block;
	margin: 5px 10px 5px 0;
	border: 1px solid #ddd;
	padding: 10px;
	background: #fcfcfc;
}
.listfile li:hover {
	border-color: #bbb;
}
.listfile li a {
	display: block;
}
.listfile li a:hover {
	cursor: pointer;
}
.listfile li span.filename {
	display: block;
	margin-top: 5px;
	font-size: 11px;
	text-align: center;
}
.listfile li.selected {
	border-color: #3493f5;
	background: #eaf3fd;
}
.mediaWrapper {
	padding: 5px;
	width: 700px;
	min-height: 350px;
}
.mediaWrapper p {
	margin: 10px 0;
}
.mediaWrapper p:first-child {
	margin-top: 0;
}
.imgpreview {
	width: 249px;
	max-width: none;
}
.imginfo {
	background: #eee;
	padding: 10px 20px 10px 10px;
	border: 1px solid #ddd;
}
.imgdetails label {
	display: block;
	margin-bottom: 2px;
}
.imgdetails input, .imgdetails textarea {
	padding: 7px 5px;
	border: 1px solid #bbb;
	background: #fcfcfc;
}
/*** MESSAGES STYLES ***/

.messagepanel {
}
.messagemenu {
	background: #97400C;
	margin-top: 15px;
}
.messagemenu ul {
	list-style: none;
	overflow: hidden;
	clear: both;
}
.messagemenu ul li {
	display: inline-block;
	float: left;
	border-right: 1px solid rgba(255,255,255,0.2);
	text-transform: uppercase;
	font-size: 11px;
}
.messagemenu ul li a {
	display: block;
	padding: 12px 16px;
	color: #fff;
}
.messagemenu ul li a:hover {
	text-decoration: none;
	background: rgba(255,255,255,0.1);
}
.messagemenu ul li.active {
	border: 1px solid #97400C;
	border-bottom: 0;
}
.messagemenu ul li.active a {
	background: #fff;
	color: #97400C;
}
.messagemenu ul li.pull-right {
	float: right;
	border-right: 0;
	border-left: 1px solid rgba(255,255,255,0.2);
}
.messagemenu ul li.back {
	display: none;
	border-right: 0;
}
.messagemenu ul li.back a {
	cursor: pointer;
}
.messagecontent {
	overflow: hidden;
	clear: both;
}
.messageleft {
	width: 325px;
	border: 1px solid #97400C;
	border-top: 0;
	height: 600px;
	float: left;
	background: #f7f7f7;
}
.messageright {
	background: #fff;
	margin-left: 325px;
	border: 1px solid #97400C;
	border-top: 0;
	border-left: 0;
	height: 600px;
}
.messagesearch {
	padding: 10px;
	background: #fff;
	border-bottom: 1px solid #97400C;
}
.messagesearch input {
	margin: 0;
	padding: 8px 10px;
	height: auto;
	background: #fff url(../images/icons/search.png) no-repeat 275px 8px;
}
.msglist {
	list-style: none;
	overflow: auto;
	height: 540px;
}
.msglist li {
	display: block;
	padding: 10px;
	border-bottom: 1px solid #ddd;
	overflow: hidden;
	clear: both;
	cursor: pointer;
}
.msglist li.unread {
	background: #fff;
}
.msglist li.selected {
	background: #97400C;
}
.msglist li .thumb {
	width: 40px;
	height: 40px;
	float: left;
}
.msglist li .summary {
	margin-left: 50px;
	color: #666;
	font-size: 12px;
	line-height: normal;
}
.msglist li.selected .summary {
	color: #fff;
}
.msglist li h4 {
	font-size: 13px;
	color: #97400C;
	line-height: 14px;
}
.msglist li.selected h4 {
	color: #fff;
}
.msglist li .date {
	height: 10px;
	color: #999;
	margin-top: -5px;
}
.msglist li.selected .date {
	color: #fff;
	opacity: 0.6;
}
.msglist li p {
	line-height: 10px;
	margin-top: 5px;
}
.messageview {
	overflow: auto;
	height: 450px;
}
.messageview .subject {
	padding: 14px 20px 13px 20px;
	font-size: 16px;
	line-height: 28px;
	padding-right: 150px;
}
.messageview .btn-group {
	margin-top: 12px;
	margin-right: 10px;
}
.messageview .btn-group .btn {
	font-size: 11px;
	text-transform: uppercase;
}
.msgauthor {
	padding: 10px 20px;
	border: 1px solid #ddd;
	border-left: 0;
	border-right: 0;
	overflow: hidden;
	clear: both;
}
.msgauthor .thumb {
	width: 30px;
	height: 30px;
	float: left;
	margin-top: 5px;
}
.msgauthor .authorinfo {
	margin-left: 40px;
}
.msgauthor .authorinfo h5 {
	font-size: 12px;
	line-height: 10px;
}
.msgauthor .authorinfo h5 span {
	font-size: 12px;
	color: #999;
	margin-left: 5px;
}
.msgauthor .authorinfo .to {
	font-size: 11px;
	color: #999;
	display: block;
	margin-top: -3px;
}
.msgauthor .authorinfo .date {
	font-size: 12px;
	color: #999;
}
.msgbody {
	padding: 20px;
	color: #666;
}
.msgbody p {
	margin: 20px 0;
}
.msgbody p:first-child {
	margin-top: 0;
}
.msgbody p:last-child {
	margin-bottom: 0;
}
.msgreply {
	padding: 10px;
	border-top: 1px solid #97400C;
}
.msgreply .thumb {
	width: 40px;
	height: 40px;
	float: left;
}
.msgreply .reply {
	margin-left: 50px;
}
.msgreply textarea {
	display: block;
	width: 100%;
	height: 128px;
	-moz-box-sizing: border-box;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
}
/*** TABLES ***/

.dataTable {
	margin-bottom: 0;
}
.dataTable th, .dataTable td {
	font-size: 12px;
}
.dataTables_wrapper {
	position: relative;
}
.dataTables_length, .dataTables_info {
	background: #eee;
	padding: 10px;
	font-size: 11px;
	border: 1px solid #ddd;
}
.dataTables_length {
	border-bottom: 0;
}
.dataTables_info {
	border-top: 0;
}
.dataTables_filter {
	position: absolute;
	top: 12px;
	right: 10px;
}
.dataTables_filter input {
	width: 150px;
	margin: 0 0 0 10px;
}
.dataTables_paginate {
	position: absolute;
	bottom: 10px;
	right: 10px;
}
.dataTables_paginate .first, .dataTables_paginate .previous, .dataTables_paginate .paginate_active, .dataTables_paginate .paginate_button, .dataTables_paginate .next, .dataTables_paginate .last {
	padding: 5px 10px;
	border: 1px solid #ccc;
	border-left: 0;
	font-size: 11px;
	background: #eee;
	cursor: pointer;
}
.dataTables_paginate span:hover {
	background-color: #ddd;
}
.dataTables_paginate .first {
	border-left: 1px solid #ccc;
}
.dataTables_paginate .paginate_active {
	background: #fff;
}
.dataTables_paginate .paginate_button:hover {
	background: #eee;
}
.dataTables_paginate .paginate_button_disabled {
	cursor: default;
	color: #ccc;
	background: #eee;
}
.dataTables_paginate a {
	color: #666;
}
.dataTables_paginate a:hover {
	text-decoration: none;
}
.dataTables_length select {
	width: auto !important;
	margin: 0;
}
.dataTables_scrollHead {
	background: #333;
}
.dataTables_scrollHead table {
	border-bottom: 0;
}
#dyntable2_wrapper .dataTables_filter {
	position: static;
	padding: 10px;
	background: #eee;
	text-align: right;
	border-left: 1px solid #ccc;
	border-right: 1px solid #ccc;
}
#dyntable2_info {
	border-top: 1px solid #ddd;
}
/*** GRAPHS & CHARTS ***/

.stackControls {
	margin-right: 3px;
}
.stackControls, .graphControls {
	display: inline-block;
	float: left;
}
.stackControls .btn, .graphControls .btn {
	font-size: 11px;
}
/***  TYPOGRAPHY ***/

ul.list-unordered, ol.list-ordered, ul.list-unordered ul, ol.list-ordered ol {
	margin: 0 0 0 25px;
	padding: 0;
}
ul.list-checked, ol.list-checked, ul.list-checked2, ol.list-checked2 {
	list-style: none;
	margin: 0;
}
ul.list-checked li, ol.list-checked li {
	background: url(../images/check.png) no-repeat 0 2px;
	padding-left: 25px;
	display: block;
}
ul.list-checked2 li, ol.list-checked2 li {
	background: url(../images/check2.png) no-repeat 0 2px;
	padding-left: 25px;
	display: block;
}
ul.list-nostyle ul, ol.list-style ol, ul.list-nostyle ol, ol.list-style ul {
	margin: 0 0 0 25px;
	padding: 0;
}
ul.list-nostyle li, ol.list-nostyle li {
	list-style: none;
}
ul.list-nostyle li span, ol.list-nostyle li span {
	vertical-align: top;
}
ul.list-inline li {
	display: inline-block;
	margin: 0 5px 10px 0;
}
/*** ELEMENTS & WIDGETS ***/

.tooltipsample li {
	display: inline-block;
	margin-right: 5px;
	list-style: none;
}
.popoversample li {
	display: inline-block;
	margin-right: 5px;
	list-style: none;
}
.pargroup {
	border: 1px solid #ccc;
	background: #fff;
	overflow: hidden;
}
.pargroup .par {
	border-bottom: 1px solid #ddd;
	padding: 10px;
}
.pargroup .par:last-child {
	border-bottom: 0;
}
.pargroup .par p.pull-right {
	margin-top: -20px;
	font-size: 11px;
}
.pargroup .par h6 {
	font-weight: normal;
	color: #666;
}
/*** FORM STYLES ***/

#colorpicker {
	margin: 0;
}
/*** FORM WIZARD STYLES ***/

.wizard .hormenu {
	list-style: none;
	clear: both;
	margin-bottom: 75px;
}
.wizard .hormenu li {
	float: left;
	width: 33.333%;
}
.wizard .hormenu li a {
	display: block;
	padding: 10px 15px;
	background: #fff;
	border: 1px solid #97400C;
	border-left: 0;
}
.wizard .hormenu li:first-child a {
	border-left: 1px solid #97400C;
}
.wizard .hormenu li a:hover {
	text-decoration: none;
}
.wizard .hormenu li a span.h2 {
	font-size: 16px;
	color: #999;
	display: block;
	margin-bottom: 5px;
}
.wizard .hormenu li span.label {
	display: block;
	color: #999;
	background: none;
	text-shadow: none;
	padding: 0;
	font-size: 12px;
}
.wizard .hormenu li a span.dot span {
	width: 20px;
	height: 20px;
	display: inline-block;
	background: url(../img/steps.png) no-repeat 0 -40px;
}
.wizard .hormenu li:first-child a span.dot {
	margin-left: 47%;
	text-align: left;
}
.wizard .hormenu li:last-child a span.dot {
	margin-right: 47%;
	text-align: right;
}
.wizard .hormenu li a.done {
	background: #97400C;
	border-right: 1px solid rgba(255,255,255,0.2);
}
.wizard .hormenu li a.done span.label {
	color: #fff;
}
.wizard .hormenu li a.done span.h2 {
	color: #fff;
	opacity: 0.6;
}
.wizard .hormenu li a.done span.dot span {
	background-position: 0 -20px;
}
.wizard .hormenu li:first-child a.done span.dot span {
	background-position: 0 0;
}
.wizard .hormenu li a.selected {
	background: #97400C;
}
.wizard .hormenu li a.selected span.dot span {
	background-position: 0 -120px;
}
.wizard .hormenu li:first-child a.selected span.dot span {
	background-position: 0 -100px;
}
.wizard .hormenu li a.selected span.label {
	color: #fff;
}
.wizard .hormenu li a.selected span.h2 {
	color: #fff;
}
.stepContainer {
	width: auto !important;
	border: 2px solid #97400C;
	border-bottom: 0;
}
.stepContainer .content h4 {
}
.stepContainer p {
	margin: 20px 0;
}
.stepContainer .par p {
	margin: 10px 0;
	line-height: 21px;
}
.stepContainer .par p:last-child {
	border-bottom: 0;
}
.actionBar {
	padding: 15px;
	position: relative;
	overflow: hidden;
	clear: both;
	border: 2px solid #97400C;
	border-top: 1px solid #97400C;
	background: #fff;
}
.actionBar .loader {
	float: left;
	display: none;
}
.actionBar a {
	float: right;
	display: inline-block;
	padding: 5px 15px;
	background: #fff;
	color: #97400C;
	margin-left: 5px;
	border: 2px solid #97400C;
}
.actionBar a:hover {
	text-decoration: none;
	background: #97400C;
	color: #fff;
}
.actionBar a.buttonDisabled {
	background: #fff;
	border: 2px solid #97400C;
	color: #97400C;
	opacity: 0.5;
}
.actionBar a.buttonDisabled:hover {
	cursor: default;
}
.actionBar a.buttonDisabled:active {
	-moz-box-shadow: none;
	-webkit-box-shadow: none;
	box-shadow: none;
}
.actionBar .msgBox {
	margin: 40px 0 10px 0;
	position: relative;
}
.actionBar .msgBox .content {
	padding: 7px 10px;
	background: #fffccc;
	color: #333;
	border: 1px solid #FEEA7A;
}
.actionBar .msgBox .close {
	padding: 0 2px 2px 2px;
	background: none;
	line-height: 10px;
	text-transform: lowercase;
	font-size: 10px;
	position: absolute;
	top: 5px;
	right: 7px;
	color: #333;
	text-shadow: none;
	font-weight: bold;
	-moz-border-radius: 1px;
	-webkit-border-radius: 1px;
	border-radius: 1px;
}
.actionBar .msgBox .close:hover {
	background: #333;
	color: #eee;
}
.tabbedwizard .stepContainer {
	padding: 30px;
	background: #fff;
}
.tabbedwizard .stepContainer h4 {
	font-size: 14px;
	border-bottom: 1px solid #ddd;
	color: #666;
}
.wizard .tabbedmenu {
	list-style: none;
	background: #97400C;
	padding: 10px;
	padding-bottom: 0;
	height: 61px;
}
.wizard .tabbedmenu li {
	display: inline-block;
	margin-right: 5px;
	position: relative;
	bottom: -1px;
}
.wizard .tabbedmenu li a {
	display: block;
	padding: 10px 20px;
	color: #fff;
	background: rgba(255,255,255,0.1);
}
.wizard .tabbedmenu li a span {
	text-shadow: none;
	padding: 0;
	background: none;
	color: #fff;
	font-size: 12px;
}
.wizard .tabbedmenu li a span.h2 {
	color: #fff;
	opacity: 0.5;
	display: block;
	font-size: 18px;
	font-weight: normal;
}
.wizard .tabbedmenu li a:hover {
	text-decoration: none;
}
.wizard .tabbedmenu li a.selected, .wizard .tabbedmenu li a.done {
	background: #fff;
	color: #97400C;
	border: 0;
}
.wizard .tabbedmenu li a.selected span.h2, .wizard .tabbedmenu li a.selected span {
	color: #235688;
}
.wizard .tabbedmenu li a.done span.h2, .wizard .tabbedmenu li a.done span {
	color: #235688;
}
.wizard.wizard-inverse .hormenu li a {
	border-color: #333;
}
.wizard.wizard-inverse .hormenu li a.selected, .wizard.wizard-inverse .hormenu li a.done {
	background-color: #333;
	border-color: #333;
	border-right-color: rgba(255,255,255,0.1);
}
.wizard.wizard-inverse .stepContainer {
	border-color: #333;
}
.wizard.wizard-inverse .stepContainer .content h4 {
	background-color: #333;
}
.wizard.wizard-inverse .actionBar {
	border-color: #333;
}
.wizard.wizard-inverse .actionBar a {
	border-color: #333;
	color: #333;
}
.wizard.wizard-inverse .actionBar a:hover {
	background-color: #333;
	color: #fff;
}
.wizard.wizard-inverse .actionBar a.buttonDisabled:hover {
	background-color: #fff;
	color: #333;
}
/*** EDIT PROFILE ***/

.profile-left .taglist {
	list-style: none;
}
.profile-left .taglist li {
	display: block;
	margin-bottom: 1px;
}
.profile-left .taglist li a {
	color: #666;
	display: block;
	padding: 7px 10px;
	background: #eee;
	position: relative;
}
.profile-left .taglist li a:hover {
	text-decoration: none;
	background: #ddd;
}
.profile-left .taglist li a span {
	position: absolute;
	top: 8px;
	right: 10px;
	opacity: 0.3;
}
.profilethumb {
	text-align: center;
	position: relative;
	overflow: hidden;
}
.profilethumb a {
	display: none;
	font-size: 11px;
	position: absolute;
	top: 5px;
	right: 5px;
	padding: 2px 7px;
	background: #333;
	color: #fff;
}
.profilethumb a:hover {
	text-decoration: none;
	background: #444;
}
.editprofileform label {
	float: left;
	width: 100px;
	padding-top: 5px;
}
.editprofileform input[type=checkbox] {
	margin: 0;
	margin-right: 10px;
	vertical-align: middle;
}
.editprofileform p {
	margin: 20px 0;
}
/*** SEARCH RESULTS PAGE ***/

.resultslist {
	list-style: none;
}
.resultslist li {
	display: block;
	margin-top: 20px;
}
.resultslist li:first-child {
	margin-top: 0;
}
.resultslist h3 {
	font-weight: normal;
	margin: 0;
	font-size: 16px;
}
.resultslist .link {
	display: block;
	color: #999;
}
.resultslist .link:hover {
	text-decoration: none;
	color: #666;
}
.sidebarlabel {
	margin-bottom: 5px;
}
/*** ERROR PAGE ***/

.errortitle {
	text-align: center;
	margin-top: 5%;
}
.errortitle h4 {
	font-size: 24px;
	margin-bottom: 20px;
}
.errortitle span {
	display: inline-block;
	font-size: 120px;
	background: #333;
	color: #fff;
	line-height: normal;
	padding: 10px 30px;
	margin-left: 7px;
}
.errortitle .errorbtns {
	margin-top: 20px;
}
.errortitle .errorbtns a {
	margin-right: 7px;
	display: inline-block;
}
/*** INVOICE PAGE ***/

.invoice_logo {
	margin-bottom: 30px;
}
.table-invoice, .table-invoice-full {
	border-color: #ccc;
	border-top: 1px solid #ccc !important;
}
.table-invoice tr td, .table-invoice-full tr td {
	border-color: #ccc;
}
.table-invoice tr td:first-child {
	background: #eee;
	font-size: 11px;
	text-transform: uppercase;
}
.table-invoice tr td:last-child {
	background: #fff;
}
.table-invoice-full tr td {
	background: #f7f7f7;
}
.table-invoice-full th.right, .table-invoice-full td.right {
	text-align: right;
}
.invoice-table {
	width: 100%;
	border: 0;
	margin-top: 15px;
}
.invoice-table tr td {
	line-height: 26px;
	border: 0;
}
.invoice-table td.right {
	text-align: right;
	background: transparent !important;
}
.invoice-table td.numlist strong {
	display: block;
	border-top: 1px solid #ddd;
	padding: 7px 0;
}
.amountdue {
	text-align: right;
}
.amountdue h1 {
	text-align: center;
	line-height: normal;
	border: 1px solid #ccc;
	background: #fcfcfc;
	display: inline-block;
	padding: 10px 30px;
	width: 200px;
}
.amountdue h1 span {
	display: block;
	font-size: 12px;
	text-transform: uppercase;
	color: #666;
}
.amountdue .btn {
	margin-top: 15px;
	width: 222px;
}
.msg-invoice {
	padding: 0 !important;
}
.msg-invoice h4 {
	font-size: 12px;
	text-transform: uppercase;
}
.msg-invoice p {
	font-size: 11px;
	line-height: 18px;
}
/*** DISCUSSION STYLES ***/

.sidebarlist {
	list-style: none;
}
.sidebarlist li {
	padding: 7px 0;
	border-bottom: 1px solid #ddd;
}
.sidebarlist li i {
	float: left;
	position: relative;
	top: 3px;
}
.sidebarlist li a {
	padding-left: 10px;
}
.sidebarlist li a:hover {
	text-decoration: none;
}
.sidebarlist li a span {
	color: #ccc;
	float: right;
	font-size: 11px;
}
.topictitle {
	font-size: 18px;
	color: #333;
}
.topicpanel {
	padding: 15px 15px;
	border: 1px solid #ddd;
	background: #fcfcfc;
	margin: 20px 0;
	box-shadow: 0 2px 0 rgba(0,0,0,0.03);
}
.topicpanel .author-thumb {
	float: left;
	overflow: hidden;
	width: 70px;
}
.topicpanel .topic-content {
	margin-left: 90px;
}
.topicpanel h5 {
	font-size: 14px;
}
.topicpanel .topic-content p {
	margin: 15px 0;
}
.topicpanel .topic-content p:first-child {
	margin-top: 0;
}
.topicpanel .topic-content p:last-child {
	margin-bottom: 0;
	color: #999;
}
.topicpanel .topic-content p.date {
	font-size: 11px;
}
.comments {
	list-style: none;
}
.comments li {
	display: block;
	overflow: hidden;
	clear: both;
	border-bottom: 1px dashed #ddd;
	padding-bottom: 25px;
	margin-bottom: 25px;
}
.comments li:last-child {
	padding-bottom: 0;
	margin-bottom: 0;
	border-bottom: 0;
}
.comments li .authorimg {
	display: block;
	float: left;
	margin-right: 20px;
	margin-top: 5px;
	overflow: hidden;
	width: 60px;
}
.comments li .comment {
	margin-left: 75px;
	position: relative;
}
.comments li:last-child .comment {
	margin-bottom: 0;
	padding-bottom: 0;
	border-bottom: 0;
}
.comments li .commentreply {
	font-size: 11px;
	text-transform: uppercase;
}
.comments li .replybutton:hover {
	color: #fff;
}
.comments li .commenttime {
	font-size: 11px;
	color: #999;
	display: inline-block;
	margin-left: 10px;
}
.comments li .commentbody {
	margin-top: 15px;
}
.comments ul {
	margin-left: 75px;
	margin-top: 25px;
	border-top: 1px dashed #ddd;
	padding-top: 25px;
}
.comments ul li:last-child .comment {
	margin-bottom: 0;
	padding-bottom: 0;
	border-bottom: 0;
}
.replypanel {
	margin: 20px 0;
}
.replypanel .author-thumb {
	float: left;
	margin-top: 5px;
	overflow: hidden;
	width: 55px;
}
.replypanel .topic-content {
	margin-left: 70px;
}
.replypanel h5 {
	font-size: 14px;
}
.replypanel p {
	margin: 10px 0;
}
.replypanel textarea {
	width: 100%;
	background: #fcfcfc;
	border: 1px solid #ccc;
	padding: 7px 5px;
	min-height: 100px;
	resize: vertical;
	-moz-box-sizing: border-box;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
}
.replypanel textarea:focus {
	border-color: #ccc;
	color: #666;
	background: #fff;
	font-style: normal;
	box-shadow: 1px 1px 5px rgba(0,0,0,0.1);
}
/*** BLOG PANEL ***/

.gridblog {
	list-style: none;
}
.gridblog::after {
	clear: both;
	content: '';
	display: block;
}
.gridblog li {
	width: 33.3333%;
	float: left;
}
.gridblog li .inner {
	border-right: 1px solid #ccc;
	border-bottom: 1px solid #ccc;
	padding: 20px;
}
.gridblog li .gridthumb {
	position: relative;
}
.gridblog li .gridimg {
	display: block;
	position: relative;
}
.gridblog li .overlay {
	background: rgba(0,0,0,0.65);
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	display: none;
}
.gridblog li .overlay div {
	position: absolute;
	top: 50%;
	left: 50%;
	width: 50px;
	height: 50px;
}
.gridblog li .overlay span {
	position: relative;
	display: block;
	top: -50%;
	left: -50%;
	font-size: 24px;
	background: #000;
	width: 60px;
	height: 60px;
	-moz-border-radius: 50px;
	-webkit-border-radius: 50px;
	border-radius: 50px;
	overflow: hidden;
	opacity: 0.8;
}
.gridblog li .overlay span i {
	margin: 17px 0 0 15px;
	color: #fff;
}
.gridblog li .blogdate {
	position: absolute;
	bottom: 0;
	left: 0;
	background: #F3A00F;
}
.gridblog li .blogdate .icon {
	float: left;
	background: #333;
	color: #fff;
	padding: 5px 0;
	text-align: center;
	width: 30px;
}
.gridblog li .blogdate .date {
	min-width: 50px;
	padding: 5px 10px;
	color: #fff;
	text-transform: uppercase;
	font-size: 12px;
	margin-left: 30px;
}
.gridblog li .inner h3 {
	font-size: 20px;
	margin-top: 10px;
	line-height: 28px;
}
.gridblog li .inner h3 a:hover {
	text-decoration: none;
	color: #333;
}
.gridblog li .blogmeta {
	line-height: normal;
	margin-top: 0;
	font-size: 11px;
	margin: 2px 0 12px;
}
.gridblog li .blogmeta a {
	text-transform: none;
}
.gridblog li .readmore {
	margin-top: 15px;
	display: block;
	text-transform: uppercase;
	font-size: 12px;
}
.gridblog li .readmore:hover {
	text-decoration: none;
}
/*** TIMELINE STYLES ***/

.timelinelist {
	list-style: none;
	border-left: 2px solid #ccc;
	padding: 30px 0 20px 10px;
	margin-left: 53px;
}
.timelinelist li {
	margin-bottom: 20px;
}
.timelinelist li .tl-icon {
	position: relative;
	margin-left: -42px;
	display: inline-block;
	padding: 15px 18px;
	font-size: 28px;
	background: #f7f7f7 url(../images/bg1.png);
	border: 2px solid #ccc;
	color: #666;
	float: left;
	-moz-border-radius: 50px;
	-webkit-border-radius: 50px;
	border-radius: 50px;
}
.timelinelist li .tl-icon .iconfa-picture {
	display: inline-block;
	margin: 2px 0;
}
.timelinelist li .tl-post {
	margin-left: 50px;
	background: #fff;
	border: 1px solid #ccc;
}
.timelinelist li .tl-post textarea {
	margin: 0;
	height: auto;
	height: 10px;
}
.timelinelist li .tl-texta {
	padding: 15px;
}
.timelinelist li .tl-author {
	padding: 15px 15px 0 15px;
}
.timelinelist li .tl-author::after {
	clear: both;
	content: '';
	display: block;
}
.timelinelist li .tl-thumb {
	width: 25px;
	border: 1px solid #ddd;
	padding: 3px;
	float: left;
}
.timelinelist li .tl-thumb img {
	display: block;
}
.timelinelist li .tl-body {
	padding: 0 15px 15px 15px;
}
.timelinelist li .tl-link {
	background: #f7f7f7;
	border-top: 1px solid #ddd;
	padding: 15px;
}
.timelinelist li .tl-link::after {
	clear: both;
	display: block;
	content: '';
}
.timelinelist li .tl-action {
	background: #fcfcfc;
	border-top: 1px solid #ddd;
}
.timelinelist li .tl-action::after {
	content: '';
	clear: both;
	display: block;
}
.timelinelist li .tl-action a {
	float: left;
	display: inline-block;
	padding: 5px 20px;
	border-right: 1px solid #ddd;
}
.timelinelist li .tl-action a:hover {
	background: #eee;
	color: #333;
	text-decoration: none;
}
.timelinelist li h5 {
	float: left;
	color: #666;
	margin-left: 10px;
	font-size: 12px;
}
.timelinelist li h5 a {
	font-weight: bold;
}
.timelinelist li h5 small {
	display: block;
	font-size: 10px;
	color: #999;
}
.timelinelist li .linkimg {
	width: 35%;
	float: left;
}
.timelinelist li .linkimg img {
	display: block;
}
.timelinelist li .linkdetails {
	float: left;
	margin-left: 2%;
	width: 60%;
}
.timelinelist li .linkdetails h5 {
	display: block;
	float: none;
	margin: 0;
	font-size: 13px;
}
.timelinelist li .linkdetails p {
	color: #666;
	display: block;
	margin-top: 5px;
	font-size: 11px;
}
.timelinelist li .tl-images {
	padding: 0 15px 15px 15px;
}
.timelinelist li .tl-images ul {
	list-style: none;
}
.timelinelist li .tl-images ul li {
	display: inline-block;
	margin: 0;
}
.timelinelist li .tl-images ul li a {
	display: block;
	width: 162px;
}
.timelinelist li .tl-images ul li a img {
	display: block;
}
.timelinelist li .tl-comments {
	padding: 15px;
	border-top: 1px solid #ddd;
}
.timelinelist li .tl-comments ul {
	list-style: none;
}
.timelinelist li .tl-comments ul li {
	margin-bottom: 10px;
	display: block;
	border-bottom: 1px dotted #ddd;
	padding-bottom: 10px;
}
.timelinelist li .tl-comments ul li .c-thumb {
	margin-top: 5px;
	width: 30px;
	float: left;
}
.timelinelist li .tl-comments ul li .c-text {
	margin-left: 40px;
	font-size: 11px;
	color: #666;
}
.timelinelist li .tl-comments ul li .c-text h6 {
	font-size: 11px;
	font-weight: normal;
}
.timelinelist li .tl-comments ul li .c-text h6 a {
	font-weight: bold;
}
.timelinelist li .tl-comments ul li.c-input .c-thumb {
	margin-top: 0;
}
.timelinelist li .tl-comments ul li:last-child {
	margin-bottom: 0;
	padding-bottom: 0;
	border-bottom: 0;
}
/*** CHAT PAGE STYLES ***/

.chatcontent {
	position: relative;
	padding: 0;
	line-height: 21px;
}
.chatcontent .messagebox {
	background: #fff;
	border: 1px solid #ccc;
	padding: 10px;
	margin-bottom: 20px;
}
.chatcontent .messagebox::after {
	content: '';
	clear: both;
	display: block;
}
.chatcontent .inputbox {
	display: block;
}
.chatcontent .messagebox input {
	padding: 8px 5px 8px 30px;
	display: inline-block;
	background: #fff url(../images/chat.png) no-repeat 8px 12px;
	width: 100%;
	margin: 0;
}
.chatmessage {
	height: 425px;
	border: 1px solid #ccc;
	background: #fff;
	overflow: auto;
	position: relative;
	margin-bottom: 10px;
}
#chatmessageinner p img {
	display: inline-block;
	vertical-align: middle;
	float: left;
}
#chatmessageinner p {
	padding: 10px;
}
#chatmessageinner .msgblock {
	background: #fff;
	margin-left: 40px;
	padding: 10px;
	border: 1px solid #ddd;
	display: block;
}
#chatmessageinner .time {
	font-size: 11px;
	color: #999;
	font-style: italic;
}
#chatmessageinner .msg {
	margin-top: 10px;
	display: block;
}
#chatmessageinner p.reply img {
	display: inline-block;
	vertical-align: middle;
	float: right;
}
#chatmessageinner p.reply .msgblock {
	margin: 0 40px 0 0;
}
.chatusers {
	list-style: none;
	line-height: 21px;
}
.chatusers li {
	border: 1px solid #ccc;
	border-top: 0;
	position: relative;
	padding: 1px;
}
.chatusers li:first-child {
	border-top: 1px solid #ccc;
}
.chatusers li span.msgcount {
	position: absolute;
	top: 12px;
	right: 10px;
	font-size: 10px;
	padding: 3px 5px;
	line-height: 10px;
	color: #fff;
	background: #FB9337;
	font-weight: bold;
	-moz-border-radius: 50px;
	-webkit-border-radius: 50px;
	border-radius: 50px;
}
.chatusers li a {
	padding: 8px 5px;
	display: block;
	color: #666;
}
.chatusers li.online a {
	background: url(../images/online.png) no-repeat right 16px;
}
.chatusers li.new a {
	font-weight: bold;
}
.chatusers li a:hover {
	background-color: #eee;
	text-decoration: none;
}
.chatusers li a img {
	vertical-align: middle;
	display: inline-block;
	margin-right: 10px;
}
/*** PEOPLE DIRECTORY ***/

.peoplegroup {
	display: inline-block;
	margin-bottom: 10px;
}
.peoplegroup li {
	border-right: 1px solid #ddd;
	display: inline-block;
	float: left;
	padding: 0 10px;
}
.peoplegroup li:first-child {
	padding-left: 0;
}
.peoplegroup li:last-child {
	border-right: 0;
}
.peoplegroup li a {
	display: block;
	padding: 2px 10px;
	font-size: 11px;
	text-transform: uppercase;
	color: #666;
}
.peoplegroup li a:hover {
	background: #ddd;
	color: #666;
	text-decoration: none;
}
.peoplegroup li.active a {
	background: #333;
	color: #fff;
}
.alphabets {
	list-style: none;
	border-top: 1px solid #ccc;
	border-bottom: 1px solid #ccc;
	border-right: 1px solid #ccc;
	background: #fff;
}
.alphabets::after {
	clear: both;
	content: '';
	display: block;
}
.alphabets li {
	display: inline-block;
	float: left;
	border-left: 1px solid #ccc;
	padding: 5px 10px;
	color: #999;
	width: 10px;
}
.alphabets li:last-child {
	border-right: 1px solid #ccc;
}
.peoplelist {
	margin: 25px 0;
}
.peoplelist .peoplewrapper {
	border: 1px solid #ccc;
	padding: 15px;
	background: #fff;
	height: 115px;
	margin-bottom: 20px;
}
.peoplelist .thumb {
	float: left;
}
.peoplelist .thumb img {
	display: block;
	width: 80px;
}
.peoplelist .peopleinfo {
	margin-left: 95px;
}
.peoplelist .peopleinfo h4 {
	font-size: 15px;
}
.peoplelist .peopleinfo h4 span {
	font-family: sans-serif;
	font-size: 10px;
	text-transform: uppercase;
	margin-left: 5px;
}
.peoplelist .peopleinfo h4 span.on {
	color: green;
}
.peoplelist .peopleinfo h4 span.off {
	color: #999;
}
.peoplelist .peopleinfo ul {
	list-style: none;
	font-size: 11px;
	color: #666;
}
.peoplelist .peopleinfo ul li {
	line-height: 18px;
}
.peoplelist .peopleinfo ul li span {
	line-height: 18px;
}
.onlineuserpanel {
	width: 200px;
	height: 100%;
	background: #333;
	position: fixed;
	top: 0;
	right: 0;
	display: none;
}
.onlineuserpanel .slimScrollDiv {
	border: 0;
}
.onlineusers ul {
	list-style: none;
	position: relative;
}
.onlineusers ul li {
	display: block;
	padding: 7px;
	border-bottom: 1px solid #3c3c3c;
	height: 25px;
	font-family: sans-serif;
	font-size: 11px;
	cursor: pointer;
}
.onlineusers ul li:hover {
	cursor: pointer;
	background: #373737;
}
.onlineusers ul li.on {
	background-image: url(../images/on.png);
	background-repeat: no-repeat;
	background-position: 180px center;
}
.onlineusers ul li img {
	width: 24px;
	display: block;
	float: left;
}
.onlineusers ul li span {
	display: block;
	margin-left: 29px;
	color: #999;
}
.chatwindows {
	position: fixed;
	bottom: 0;
	right: 200px;
	z-index: 100;
	display: none;
}
.chatwin {
	position: relative;
	width: 230px;
	border: 1px solid #97400C;
	border-bottom: 0;
	background: #fff;
	margin-right: 5px;
	float: right;
	-moz-box-shadow: 0 0 5px rgba(0,0,0,0.6);
	-webkit-box-shadow: 0 0 5px rgba(0,0,0,0.6);
	box-shadow: 0 0 5px rgba(0,0,0,0.6);
}
.chatwin h4 {
	font-size: 11px;
	padding: 5px;
	background: #97400C;
	color: #fff;
}
.chatwin .close {
	position: absolute;
	top: 1px;
	right: 3px;
	color: #fff;
	font-weight: normal;
	opacity: 0.3;
	text-shadow: none;
	font-size: 16px;
	cursor: pointer;
}
.chatwin .close:hover {
	cursor: pointer;
	opacity: 0.6;
}
.chatwin .chatmsg {
	height: 180px;
}
.chatwin .chattext {
	padding: 5px;
}
.chatwin .chattext input {
	min-height: 20px;
	padding: 7px 5px;
	border: 1px solid #bbb;
	font-size: 11px;
	font-family: sans-serif;
}
#chatwinlist {
	display: inline-block;
	float: right;
	padding: 2px 6px;
	background: #fff;
	margin-right: 5px;
	margin-top: 217px;
	color: #97400C;
	border: 1px solid #97400C;
	border-bottom: 0;
	vertical-align: bottom;
	position: relative;
}
#chatwinlist span {
	cursor: pointer;
}
#chatwinlist ul {
	list-style: none;
	width: 150px;
	position: absolute;
	right: -1px;
	bottom: 25px;
	border: 1px solid #97400C;
	display: none;
}
#chatwinlist ul li {
	display: block;
	background: #fff;
	padding: 5px;
	border-bottom: 1px solid #ddd;
	cursor: pointer;
}
#chatwinlist ul li:hover {
	background: #f7f7f7;
}
#chatwinlist ul li:last-child {
	border-bottom: 0;
}
#chatwinlist h4 {
	font-family: sans-serif;
	font-size: 11px;
}
.chatmsg {
	list-style: none;
}
.chatmsg li {
	display: block;
	font-size: 11px;
	padding: 0 5px;
}
.chatenabled .mainwrapper {
	margin-right: 200px;
}
.chatenabled .mainwrapper .mainwrapper {
	margin-right: 0;
}
.chatenabled .chatwindows {
	display: block;
}
.chatenabled .onlineuserpanel {
	display: block;
}
/*** LOCK SCREEN ***/

.lockscreen {
	width: 100%;
	height: 100%;
	left: 0;
	top: 0;
	z-index: 200;
	position: fixed;
}
.lockscreen .lock-overlay {
	background: #97400C;
	opacity: 0.85;
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
}
.logwindow {
	position: absolute;
	top: 20%;
	left: 50%;
	z-index: 200;
}
.logwindow-inner {
	position: relative;
	left: -50%;
}
.logwindow-inner input {
	border: 0;
	padding: 10px;
}
.logwindow-inner form {
	width: 280px;
	text-align: center;
	color: #fff;
}
.logwindow-inner h3 {
	margin-bottom: 20px;
}
.logwindow-inner img {
	background: #fff;
	padding: 5px;
	display: inline-block;
}
.logwindow-inner h5 {
	font-size: 14px;
	color: #fff;
	margin-bottom: 20px;
}
/*** FOOTER STYLES ***/

.footer {
	font-size: 11px;
	color: #666;
	padding-top: 15px;
	margin-top: 40px;
	border-top: 1px solid #ccc;
	overflow: hidden;
	clear: both;
}
.footer .footer-left {
	float: left;
}
.footer .footer-right {
	float: right;
}
/*** CUSTOM STYLES ***/

.nopadding {
	padding: 0;
}
.nomargin {
	margin: 0;
}
.padding5 {
	padding: 5px;
}
.padding20 {
	padding: 20px;
}
.divider15 {
	clear: both;
	height: 15px;
}
.divider30 {
	height: 30px;
}
.marginleft15 {
	margin-left: 15px;
}
.marginleft5 {
	margin-left: 5px;
}
.margintop20 {
	margin-top: 20px;
}
.margin20 {
	margin: 20px;
}
.margin20-0 {
	margin: 20px 0;
}
.tooltipflot {
	background: #333;
	color: #fff;
	font-size: 11px;
	padding: 2px 10px;
}
.table thead th.right, .table tr td.right {
	text-align: right;
}
.topbar {
	display: none;
}
.width5 {
	width: 5%;
}
.width10 {
	width: 10%;
}
.width15 {
	width: 15%;
}
.width20 {
	width: 20%;
}
.width30 {
	width: 30%;
}
.width45 {
	width: 45%;
}
.width60 {
	width: 60%;
}
.width65 {
	width: 65%;
}
.width63 {
	width: 63%;
}
.width70 {
	width: 70%;
}
/*** FONT ROBOTO LIGHT ***/

strong, .headmenu .nav-header, .nav-list .nav-header, .peoplelist .peopleinfo h4, .peoplelist .peopleinfo ul li span {
	font-family: 'RobotoBold', 'Helvetica Neue', Helvetica, sans-serif;
}
.headmenu > li, .leftmenu .nav-tabs.nav-stacked a, .pagetitle h1, .shortcuts li {
	font-family: 'RobotoLight', 'Helvetica Neue', Helvetica, sans-serif;
}
.pagetitle h5, .subtitle {
	font-family: 'RobotoRegular', 'Helvetica Neue', Helvetica, sans-serif;
}
/*** FONT LATO ***/

.subtitle2, .table th, .msglist li h4, .tabbedwizard .stepContainer h4, dt, .userloggedinfo .userinfo h5, .loginpanel .inputwrapper button, .userlist li .uinfo h5 {
	font-family: 'LatoBold', 'Helvetica Neue', Helvetica, sans-serif;
	font-weight: normal;
}
/*** TRANSITION ***/

.headmenu-label, .headmenu-icon, .headmenu .count, .leftmenu .nav-tabs a, .dropdown-menu a, .shortcuts li a, .userloggedinfo ul li a, .inputwrapper input, .inputwrapper button {
	-moz-transition: all 0.2s ease-out 0s;
	-webkit-transition: all 0.2s ease-out 0s;
	transition: all 0.2s ease-out 0s;
}
/*** BOOTSTRAP OVERRIDE ***/

.close {
	text-shadow: 1px 1px rgba(255,255,255,0.4);
}
.dropdown-menu {
	margin-top: 0;
	-moz-border-radius: 0;
	-webkit-border-radius: 0;
	border-radius: 0;
}
.dropdown-menu > li > a {
	font-size: 12px;
	color: #444;
	margin: 0 5px;
	padding: 5px 10px;
}
.dropdown-menu > li > a:hover .muted {
	color: #fff;
}
.dropdown-menu > li > a:hover, .dropdown-menu > li > a:focus, .dropdown-submenu:hover > a, .dropdown-submenu:focus > a {
	background: #333;
}
.dropdown .dropdown-menu .nav-header {
	padding-left: 10px;
	padding-right: 10px;
}
.nav-tabs > .active > a, .nav-tabs > .active > a:hover, .nav-tabs > .active > a:focus {
	background-color: #97400C;
	color: #fff;
}
select, textarea, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input, .input-append input, .input-prepend input, .input-append select, .input-prepend select, .input-append .uneditable-input, .input-prepend .uneditable-input, .input-append .dropdown-menu, .input-prepend .dropdown-menu, .input-append .popover, .input-prepend .popover, .btn-group > .btn, .btn-group > .dropdown-menu, .btn-group > .popover, .input-append .add-on, .input-prepend .add-on {
	font-size: 13px;
}
.radio input[type="radio"], .checkbox input[type="checkbox"] {
	margin: 0;
}
.fileupload-new .input-append .btn-file {
	-moz-border-radius: 0 !important;
	-webkit-border-radius: 0 !important;
	border-radius: 0 !important;
}
.btn {
	font-size: 13px;
	padding: 5px 12px 5px;
	background: #eee;
	text-shadow: none;
}
.btn-file {
	padding: 4px 12px 3px 12px;
}
.fileupload .btn {
	vertical-align: top;
	color: #666;
}
.btn-group > .btn + .dropdown-toggle {
	padding-left: 3px;
}
.input-append .add-on, .input-prepend .add-on {
	height: 22px;
}
.bootstrap-timepicker-widget a.btn, .bootstrap-timepicker-widget input {
	-moz-border-radius: 0 !important;
	-webkit-border-radius: 0 !important;
	border-radius: 0 !important;
}
.tabbable > .nav-tabs {
	background: #97400C;
	margin: 0;
	border: 1px solid #97400C;
	border-bottom: 0;
	height: 40px;
}
.tabbable > .nav-tabs > li {
	float: left;
	margin: 0;
	border-right: 1px solid rgba(255,255,255,0.2);
}
.tabbable > .nav-tabs > li > a {
	color: #fff;
	border: 0;
	padding: 10px 20px;
	-moz-border-radius: 0;
	-webkit-border-radius: 0;
	border-radius: 0;
	margin: 0;
}
.tabbable > .nav-tabs > li > a:hover {
	background: rgba(255,255,255,0.1);
}
.tabbable > .nav-tabs > li.active > a {
	background: #fff;
	color: #97400C;
	border: 0;
	padding-botom: 12px;
}
.tabbable > .tab-content {
	margin-top: 0;
	border: 1px solid #97400C;
	border-top: 0;
	background: #fff;
	padding: 20px;
}
.nav-tabs.nav-stacked > li:first-child > a, .nav-tabs.nav-stacked > li:last-child > a {
	-moz-border-radius: 0;
	-webkit-border-radius: 0;
	border-radius: 0;
}
.nav-tabs.nav-stacked > li > a, .nav-tabs.nav-stacked > li > a:hover, .nav-tabs.nav-stacked > li > a:hover, .nav-tabs.nav-stacked > li > a:focus {
	border-color: #97400C;
}
.btn {
	display: inline-block;
	-moz-box-shadow: none;
	-webkit-box-shadow: none;
	box-shadow: none;
	border-color: #bbb;
	margin-bottom: 5px;
}
.btn .caret {
	margin-left: 5px;
}
.btn-small {
	-moz-border-radius: 0;
	-webkit-border-radius: 0;
	border-radius: 0;
	font-size: 11px;
	text-transform: upperfcase;
}
.btn-large {
	-moz-border-radius: 0;
	-webkit-border-radius: 0;
	border-radius: 0;
	font-size: 14px;
	padding: 10px 20px;
}
.btn-primary, .btn-primary:link {
	background: #97400C;
	border-color: #97400C;
	color: #fff;
}
.btn-primary:hover, .btn-primary:active, .btn:primary:focus, .btn-group.open .btn-primary.dropdown-toggle {
background: #0a76e5;
}
.btn-danger, .btn-danger:link {
	background: #dd0000;
	border-color: #aa0000;
}
.btn-danger:hover, .btn-danger:active, .btn-danger:focus, .btn-group.open .btn-danger.dropdown-toggle {
	background: #cc0000;
}
.btn-warning, .btn-warning:link {
	background: #fcb904;
	border-color: #daa004;
}
.btn-warning:hover, .btn-warning:active, .btn-warning:focus, .btn-group.open .btn-warning.dropdown-toggle {
	background: #edae03;
}
.btn-success, .btn-success:link {
	background: #86d628;
	border-color: #6db814;
}
.btn-success:hover, .btn-success:active, .btn-success:focus, .btn-group.open .btn-success.dropdown-toggle {
	background: #7bca1d;
}
.btn-info, .btn-info:link {
	background: #71b8ee;
	border-color: #4a96d1;
}
.btn-info:hover, .btn-info:active, .btn-info:focus, .btn-group.open .btn-info.dropdown-toggle {
	background: #5da6df;
}
.btn-inverse, .btn-inverse:link {
	background: #333;
	border-color: #272727;
}
.btn-circle {
	-moz-border-radius: 50px;
	-webkit-border-radius: 50px;
	border-radius: 50px;
	width: 20px;
	padding: 5px;
	background: none;
	border: 2px solid #ccc;
}
.btn-circle:hover {
	background: none;
	color: #ccc;
}
.btn-circle.btn-primary, .btn-circle.btn-primary:hover, .btn-circle.btn-primary:focus, .btn-circle.btn-primary:active, .btn-circle.btn-primary.active, .btn-circle.btn-primary.disabled, .btn-circle.btn-primary[disabled] {
	border-color: #97400C;
	color: #97400C;
	background: none !important;
}
.btn-circle.btn-danger, .btn-circle.btn-danger:hover, .btn-circle.btn-danger:focus, .btn-circle.btn-danger:active, .btn-circle.btn-danger.active, .btn-circle.btn-danger.disabled, .btn-circle.btn-danger[disabled] {
	border-color: #dd0000;
	color: #dd0000;
	background: none;
}
.btn-circle.btn-warning, .btn-circle.btn-warning:hover, .btn-circle.btn-warning:focus, .btn-circle.btn-warning:active, .btn-circle.btn-warning.active, .btn-circle.btn-warning.disabled, .btn-circle.btn-warning[disabled] {
	border-color: #fcb904;
	color: #fcb904;
	background: none;
}
.btn-circle.btn-success, .btn-circle.btn-success:hover, .btn-circle.btn-success:focus, .btn-circle.btn-success:active, .btn-circle.btn-success.active, .btn-circle.btn-success.disabled, .btn-circle.btn-success[disabled] {
	border-color: #86d628;
	color: #86d628;
	background: none;
}
.btn-circle.btn-info, .btn-circle.btn-info:hover, .btn-circle.btn-info:focus, .btn-circle.btn-info:active, .btn-circle.btn-info.active, .btn-circle.btn-info.disabled, .btn-circle.btn-info[disabled] {
	border-color: #71b8ee;
	color: #71b8ee;
	background: none;
}
.btn-circle.btn-inverse, .btn-circle.btn-inverse:hover, .btn-circle.btn-inverse:focus, .btn-circle.btn-inverse:active, .btn-circle.btn-inverse.active, .btn-circle.btn-inverse.disabled, .btn-circle.btn-inverse[disabled] {
	border-color: #333;
	color: #333;
	background: none;
}
.btn-circle .iconsweets-white {
	background-image: url("../images/iconsweets-icons.png");
}
.nav-list {
	border: 2px solid #333;
	background: #fff;
}
.nav-list .nav-header {
	padding: 7px 15px;
	background: #333;
	color: #fff;
	text-shadow: none;
	font-weight: normal;
}
.nav-list > li > a {
	padding: 7px 15px;
}
.nav-list > .active > a, .nav-list > .active > a:hover, .nav-list > .active > a:focus {
	background: #97400C;
}
.nav-tabs {
	border-color: #97400C;
}
.nav-tabs > .active > a, .nav-tabs > .active > a:hover, .nav-tabs > .active > a:focus {
	border-color: #97400C;
}
.nav-tabs > li > a {
	-moz-border-radius: 0;
	-webkit-border-radius: 0;
	border-radius: 0;
}
.nav-tabs > li > a:hover, .nav-tabs > li > a:focus {
	border-color: #97400C;
	background: #97400C;
	color: #fff;
}
.nav-pills > .active > a, .nav-pills > .active > a:hover, .nav-pills > .active > a:focus {
	background-color: #97400C;
}
.nav-pills > li > a {
	-moz-border-radius: 0;
	-webkit-border-radius: 0;
	border-radius: 0;
	padding: 10px 15px;
	display: inline-block;
}
.tabs-below .tab-content {
	border-top: 1px solid #97400C;
	border-bottom: 0;
}
.tabs-below > .nav-tabs > li.active > a {
	border-bottom: 1px solid #97400C !important;
	border-top: 0;
	margin-top: -1px;
}
.tabs-right {
	overflow: hidden;
	border: 1px solid #97400C;
	background: #fff;
}
.tabs-right .nav-tabs {
	margin: 0;
	border: 0;
	background: #97400C;
}
.tabs-right .tab-content {
	padding: 10px;
}
.tabs-right > .nav-tabs > li {
	margin: 0;
	border-bottom: 1px solid #2187b5;
}
.tabs-right > .nav-tabs > li:last-child {
	border-bottom: 0;
}
.tabs-right > .nav-tabs > li > a {
	border: 0;
	-moz-border-radius: 0;
	-webkit-border-radius: 0;
	border-radius: 0;
	background: #97400C;
	margin: 0;
	padding: 8px 10px;
	color: #fff;
}
.tabs-right > .nav-tabs > li > a:hover {
	background: rgba(255,255,255,0.1);
}
.tabs-right > .nav-tabs .active > a, .tabs-right > .nav-tabs .active > a:hover, .tabs-right > .nav-tabs .active > a:focus {
	background: #fff;
	color: #97400C;
	border: 0;
}
.tabs-left {
	overflow: hidden;
	border: 1px solid #97400C;
	background: #fff;
}
.tabs-left .nav-tabs {
	margin: 0;
	border: 0;
	background: #97400C;
}
.tabs-left .tab-content {
	padding: 10px;
}
.tabs-left > .nav-tabs > li {
	margin: 0;
	border-bottom: 1px solid #2187b5;
}
.tabs-left > .nav-tabs > li:last-child {
	border-bottom: 0;
}
.tabs-left > .nav-tabs > li > a {
	border: 0;
	-moz-border-radius: 0;
	-webkit-border-radius: 0;
	border-radius: 0;
	background: #97400C;
	margin: 0;
	padding: 8px 10px;
	color: #fff;
}
.tabs-left > .nav-tabs > li > a:hover {
	background: rgba(255,255,255,0.1);
}
.tabs-left > .nav-tabs .active > a, .tabs-left > .nav-tabs .active > a:hover, .tabs-left > .nav-tabs .active > a:focus {
	background: #fff;
	color: #97400C;
	border: 0;
}
.pagination {
	margin: 10px 0;
}
.pagination > ul > li a {
	border-color: #ccc;
}
.pagination-large ul > li:first-child > a, .pagination-large ul > li:first-child > span, .pagination-large ul > li:last-child > a, .pagination-large ul > li:last-child > span {
	-moz-border-radius: 0;
	-webkit-border-radius: 0;
	border-radius: 0;
}
.pagination ul > li > a, .pagination ul > li > span {
	color: #666;
}
.pager li > a {
	border-color: #ccc;
}
.pager li > a, .pager li > span {
	color: #666;
	-moz-border-radius: 0;
	-webkit-border-radius: 0;
	border-radius: 0;
	border-width: 2px;
}
.progress {
	height: 15px;
}
.progress .bar {
	-moz-box-shadow: none;
	-webkit-box-shadow: none;
	box-shadow: none;
}
.progress-primary .bar {
	background: #97400C;
}
.progress-info .bar {
	background: #71B8EE;
}
.progress-success .bar {
	background: #86D628;
}
.progress-warnng .bar {
	background: #FCB904;
}
.navbar {
	margin-bottom: 15px;
}
.navbar-inner {
	border-color: #ccc;
	background: #f7f7f7;
}
.navbar .brand {
	font-size: 14px;
	font-weight: bold;
}
.navbar .nav > li {
	border-left: 1px solid #ccc;
}
.navbar .nav > li:last-child {
	border-right: 1px solid #ccc;
}
.navbar .nav > .active > a, .navbar .nav > .active > a:hover, .navbar .nav > .active > a:focus {
	background: #fff;
}
.navbar .nav > li > a {
	padding: 11px 15px;
	font-size: 11px;
	font-weight: normal;
	text-transform: uppercase;
}
.navbar .nav > li > a:hover {
	background: #eee;
}
.navbar .nav li.dropdown.open > .dropdown-toggle, .navbar .nav li.dropdown.active > .dropdown-toggle, .navbar .nav li.dropdown.open.active > .dropdown-toggle {
	background: #fff;
}
.navbar .navbar-search.pull-right .search-query {
	margin-right: -15px;
}
.navbar .navbar-search.pull-left .search-query {
	margin-left: -15px;
}
.navbar .navbar-form.pull-right {
	margin-right: -15px;
}
.navbar .navbar-form.pull-left {
	margin-left: -15px;
}
.navbar .navbar-form input {
	width: 168px;
}
.navbar-inverse .navbar-inner {
	background: #222;
}
.navbar-inverse .nav > .active > a, .navbar-inverse .nav > .active > a:hover, .navbar-inverse .nav > .active > a:focus {
	background: #111;
}
.navbar-inverse .nav > li, .navbar-inverse .nav > li:last-child {
	border-color: #373737;
}
.navbar-inverse .nav > li > a:hover {
	background: #171717;
}
.navbar-inverse .nav li.dropdown.open > .dropdown-toggle, .navbar-inverse .nav li.dropdown.active > .dropdown-toggle, .navbar-inverse .nav li.dropdown.open.active > .dropdown-toggle {
	background: #171717;
}
.navbar-search .search-query {
	-moz-border-radius: 0;
	-webkit-border-radius: 0;
	border-radius: 0;
}
.navbar-form .btn {
	padding: 4px 10px;
	font-size: 11px;
	text-transform: uppercase;
}
.label {
	-moz-border-radius: 0;
	-webkit-border-radius: 0;
	border-radius: 0;
	font-size: 10px;
	text-shadow: none;
	font-weight: normal;
	text-transform: uppercase;
	padding: 2px 5px;
}
.badge {
	font-size: 10px;
	text-shadow: none;
	font-weight: normal;
	line-height: 19px;
	-moz-border-radius: 50px;
	-webkit-border-radius: 50px;
	border-radius: 50px;
}
.modal {
	-moz-border-radius: 0;
	-webkit-border-radius: 0;
	border-radius: 0;
}
.modal-footer .btn {
	margin: 0;
}
.popover, .popover-title {
	-moz-border-radius: 0;
	-webkit-border-radius: 0;
	border-radius: 0;
}
.popover {
	padding: 0;
}
.alert .close {
	right: -25px;
	top: 1px;
}
.table th {
	font-weight: normal;
	text-transform: uppercase;
	font-size: 12px;
	border-top: 0;
	background: #333;
	color: #fff;
}

.joblist_table_nonshedule th{
	background:#ff0000 !important;
}
.joblist_table_shedule th{
	background: #7cc131 !important;
}
.table th.centeralign, .table td.centeralign {
	text-align: center;
}
.table.table-bordered {
	border-top: 0;
	border-right: 0;
}
.table.table-bordered th {
	border-color: #444;
}
.table.table-bordered td:last-child {
	border-right: 1px solid #ddd;
}
.table .con0 {
	background: #fff;
}
.table .con1 {
	background: #f7f7f7;
}
blockquote {
	background: url(../images/blockquote.png) no-repeat 0 5px;
	font-family: 'PT Serif', Georgia, "Times New Roman", Times, serif;
	font-style: italic;
	padding-left: 40px;
}
blockquote p {
	margin: 0 !important;
}
blockquote.pull-right {
	background-position: right 5px;
	padding: 0 40px 0 0;
	border-right: 0;
}
.alert {
	border-color: #e4bf7f;
	color: #9c6c38;
	margin-bottom: 15px;
	background: rgb(246,237,186);
}
.alert .close {
	top: 0;
	right: -23px;
	color: #937f0e;
}
.alert h4 {
	color: #9c6c38;
}
.alert-error {
	border-color: #e18d9a;
	color: #da5251;
	background: rgb(246,216,216);
}
.alert-error .close, .alert-error h4 {
	color: #990000;
}
.alert-success {
	border-color: #b4da95;
	color: #468847;
	background: rgb(223,240,216);
}
.alert-success .close, .alert-success h4 {
	color: #468847;
}
.alert-info {
	border-color: #88c4e2;
	color: #3a87ad;
	background: rgb(217,237,247);
}
.alert-info .close, .alert-info h4 {
	color: #3a87ad;
}
pre.prettyprint, .accordion {
	margin-bottom: 0;
}
dl {
	margin-bottom: 15px;
}
.input-block-level {
	min-height: 37px;
}
table td.center, table th.center {
	text-align: center;
}
/*** IE FIXES ***/

.no-rgba .headmenu > li.odd {
	background: url(../images/transwhite.png);
}
.no-rgba .headmenu > li {
	border-right: 1px solid #4289d2;
}
.no-rgba .headmenu > li:first-child {
	border-left: 1px solid #4289d2;
}
.no-rgba .userloggedinfo ul li a {
	background: url(../images/transwhite.png);
}
.no-rgba .userloggedinfo ul li a:hover {
	background: url(../images/transwhite2.png);
}
.no-rgba .tab-primary.ui-tabs .ui-tabs-nav li {
	border-right: 1px solid #4289d2;
}
.no-rgba .tab-primary.ui-tabs .ui-tabs-nav li a {
	background: url(../images/transwhite.png);
}
.no-rgba .tab-primary.ui-tabs .ui-tabs-nav li.ui-state-active a {
	background: #fff;
}
.no-rgba .tab-danger.ui-tabs .ui-tabs-nav li {
	border-right: 1px solid #db4d4d;
}
.no-rgba .tab-danger.ui-tabs .ui-tabs-nav li a {
	background: url(../images/transwhite.png);
}
.no-rgba .tab-danger.ui-tabs .ui-tabs-nav li.ui-state-active a {
	background: #fff;
}
.no-rgba .tab-warning.ui-tabs .ui-tabs-nav li {
	border-right: 1px solid #fcce4f;
}
.no-rgba .tab-warning.ui-tabs .ui-tabs-nav li a {
	background: url(../images/transwhite.png);
}
.no-rgba .tab-warning.ui-tabs .ui-tabs-nav li.ui-state-active a {
	background: #fff;
}
.no-rgba .tab-success.ui-tabs .ui-tabs-nav li {
	border-right: 1px solid #aae268;
}
.no-rgba .tab-success.ui-tabs .ui-tabs-nav li a {
	background: url(../images/transwhite.png);
}
.no-rgba .tab-success.ui-tabs .ui-tabs-nav li.ui-state-active a {
	background: #fff;
}
.no-rgba .tab-info.ui-tabs .ui-tabs-nav li {
	border-right: 1px solid #9bcdf3;
}
.no-rgba .tab-info.ui-tabs .ui-tabs-nav li a {
	background: url(../images/transwhite.png);
}
.no-rgba .tab-info.ui-tabs .ui-tabs-nav li.ui-state-active a {
	background: #fff;
}
.no-rgba .tab-inverse.ui-tabs .ui-tabs-nav li {
	border-right: 1px solid #707070;
}
.no-rgba .tab-inverse.ui-tabs .ui-tabs-nav li a {
	background: url(../images/transwhite.png);
}
.no-rgba .tab-inverse.ui-tabs .ui-tabs-nav li.ui-state-active a {
	background: #fff;
}
.no-rgba .ui-accordion .ui-accordion-header a:hover {
	background: url(../images/transwhite.png);
}
.no-rgba .ui-accordion .ui-accordion-header.ui-state-active a:hover {
	background: #fff;
}
.no-rgba .accordion-primary.ui-accordion .ui-accordion-header {
	border-top: 1px solid #4289d2;
}
.no-rgba .accordion-danger.ui-accordion .ui-accordion-header {
	border-top: 1px solid #db4d4d;
}
.no-rgba .accordion-warning.ui-accordion .ui-accordion-header {
	border-top: 1px solid #fcce4f;
}
.no-rgba .accordion-success.ui-accordion .ui-accordion-header {
	border-top: 1px solid #aae268;
}
.no-rgba .accordion-info.ui-accordion .ui-accordion-header {
	border-top: 1px solid #9bcdf3;
}
.no-rgba .accordion-inverse.ui-accordion .ui-accordion-header {
	border-top: 1px solid #707070;
}
.no-rgba .fc-event {
	background: #333;
}



/*** MEDIA QUERIES ***/

@media screen and (max-width: 1024px) {
/* general */
.mainwrapper {
	overflow: hidden;
}
.header .logo {
	margin-left: -260px;
}
.header {
	width: 100%;
}
.headerinner {
	width: 100%;
	margin-left: 0;
}
.leftpanel {
	margin-left: -260px;
}
.rightpanel {
	margin-left: 0;
	width: 100%;
}
.topbar {
	display: block;
	background: #272727;
	height: 50px;
}
.barmenu {
	font-size: 18px;
	color: #fff;
	background: url(../images/barmenu.png) no-repeat center center;
	width: 50px;
	height: 50px;
	display: block;
	cursor: pointer;
}
.chatmenu {
	position: absolute;
	top: 14px;
	right: 10px;
	background: url(../images/chatimg.png) no-repeat 0 0;
	width: 23px;
	height: 21px;
	cursor: pointer;
}
/* error page */
.errorpage .topbar {
	display: none;
}
.chatenabled .mainwrapper {
	margin-right: 0;
}
.chatenabled .onlineuserpanel, #chatwindows {
	display: none;
}
}
 @media screen and (max-width: 800px) {
body {
	font-size: 12px;
}
#dashboard-left {
	width: 48.6188%;
}
#dashboard-right {
	width: 48.6188%;
}
/* forms */
.input-xxlarge {
	width: 100%;
	-moz-box-sizing: border-box;
	height: auto !important;
}
.stdform label {
	width: 150px;
}
.stdform div.par .controls {
	margin-left: 170px;
}
.stdform .stdformbutton, .stdform small.desc {
	margin-left: 170px;
}
.stdform2 span.field, .stdform2 div.field {
	margin-left: 170px;
}
.stdform span.field, .stdform div.field {
	margin-left: 170px;
}
.stdform .formwrapper, .dualselect {
	margin-left: 170px;
}
.themepixelsSkin td.mceToolbar {
	padding: 0 !important;
}
#elm1_toolbargroup {
	width: 710px;
	overflow: auto;
	padding: 10px;
}
#elm1_fullscreen {
	display: none;
}
/* boxes */
.slide_img, .entry_img {
	float: none;
	margin-bottom: 10px;
}
.slide_content, .entry_content {
	margin-left: 0;
}
}
 @media screen and (max-width: 768px) {
/* forms */
#elm1_toolbargroup {
	width: 680px;
}
/* messages */
.messageview .subject {
	padding-right: 110px;
	padding-left: 10px;
}
.msgauthor, .msgbody {
	padding: 10px;
}
.msgauthor .authorinfo h5 span {
	margin-left: 0;
	display: block;
}
/* media */
.mediaWrapper {
	width: 500px;
}
.row-fluid .span5.imginfo {
	width: auto;
	float: none;
	margin-bottom: 20px;
}
.row-fluid .span7.imgdetails {
	width: auto;
	margin: 0;
	float: none;
}
/* blog */
.gridblog li {
	width: 50%;
}
}
 @media screen and (max-width: 720px) {
#dashboard-left, #dashboard-right {
	width: 100%;
	margin: 0;
}
/* calendar */
.ui-datepicker-calendar td a {
	padding: 10px;
	font-size: 12px;
}
/* buttons */
.fontawesomeicons .span3 {
	width: 48%;
	display: inline-block;
}
.iconsweetslist li {
	width: 33.3333%;
}
/* forms */
.stdform label {
	float: none;
	width: auto;
	text-align: left;
	margin-bottom: 5px;
}
.stdform div.par .controls,  .stdform .stdformbutton, .stdform small.desc,  .stdform2 span.field, .stdform2 div.field,  .stdform span.field, .stdform div.field,  .stdform .formwrapper, .dualselect {
	margin-left: 0;
}
.input-append .add-on, .input-prepend .add-on {
	height: 20px;
}
.stdform input {
	padding: 4px 5px;
}
.stdform2 p, .stdform2 div.par {
	background: none;
}
.stepContainer p {
	margin: 10px 15px;
}
#wiz1step2_1 p {
	margin: 10px 0;
}
.tabbedwizard .stepContainer {
	padding: 30px 15px;
}
#elm1_toolbargroup {
	width: 640px;
}
/* boxes */
.bx-wrapper {
	margin-bottom: 20px;
}
.slide_img {
	float: left;
	width: 100px;
}
.slide_content {
	margin-left: 120px;
}
.entry_img {
	float: left;
}
.entry_content {
	margin-left: 120px;
}
/* media */
.mediamgr_menu li.right {
	float: none;
	margin-top: 10px;
}
.mediamgr_category ul li.right {
	float: none;
	text-align: right;
	display: block;
	border-top: 1px dashed #ddd;
	margin-top: 10px;
}
.mediamgr .mediamgr_right {
	top: 110px;
}
/* messages */
.messageleft {
	width: 241px;
}
.messageright {
	margin-left: 241px;
}
/* bootstrap */
.btn {
	padding: 4px 12px;
}
}
 @media screen and (max-width: 640px) {
.headmenu > li > a {
	padding: 25px 10px 9px;
}
/* buttons */
.glyphicons li {
	width: 50%;
}
.iconsweetslist li {
	width: 50%;
}
/* forms */
#elm1_toolbargroup {
	width: 560px;
}
/* media */
.mediamgr_category, .mediamgr_content {
	margin-right: 0;
}
.mediamgr .mediamgr_right {
	position: static;
	width: auto;
}
.mediamgr .mediamgr_rightinner {
	padding-left: 0;
}
.mediamgr_category ul li.right {
	float: right;
	border-top: 0;
	margin-top: 0;
}
}
 @media screen and (max-width: 603px) {
.headmenu > li > a {
	padding: 25px 15px 9px;
}
.userloggedinfo .userinfo small {
	display: none;
}
.userloggedinfo {
	width: 220px;
}
.userloggedinfo .userinfo {
	float: none;
	margin-left: 100px;
}
/* media */
.mediaWrapper {
	width: 400px;
}
/* table */
.dataTable th, .dataTable td {
	font-size: 11px;
	padding: 5px;
}
.dataTable th:nth-child(2), .dataTable td:nth-child(2) {
	display: none;
}
.dataTables_paginate {
	position: relative;
	margin: -25px 0 0 20px;
}
.dataTables_info {
	height: 50px;
}
#dyntable2_info {
	height: auto;
}
.dataTables_filter {
	position: relative;
	margin: -50px 0 20px 20px;
}
.dataTables_length {
	height: 70px;
}
#dyntable2_wrapper .dataTables_filter {
	margin: 0;
}
}
 @media screen and (max-width: 480px) {
.headmenu > li > a {
	padding: 25px 20px 9px;
}
.headmenu > li.right {
	padding-bottom: 13px;
}
.userloggedinfo {
	width: auto;
}
.userloggedinfo img {
	cursor: pointer;
}
.userloggedinfo .userinfo {
	position: absolute;
	top: 110px;
	z-index: 100;
	right: -1px;
	width: 200px;
	background: #fff;
	padding: 10px;
	color: #333;
	border: 2px solid #97400C;
	border-top: 0;
	display: none;
}
.userloggedinfo .userinfo::after {
	position: absolute;
	top: -6px;
	right: 45px;
	display: inline-block;
	border-right: 6px solid transparent;
	border-bottom: 6px solid white;
	border-left: 6px solid transparent;
	content: '';
}
.userloggedinfo .userinfo small {
	color: #999;
}
.userloggedinfo ul li a {
	background: #eee;
	color: #333;
	padding: 5px 10px;
	font-size: 12px;
}
.userloggedinfo ul li a:hover {
	background: #97400C;
	color: #fff;
}
.pageheader {
	padding: 15px;
	min-height: 120px;
}
.searchbar {
	position: static;
	margin-bottom: 5px;
}
.searchbar input {
	width: 100%;
	-moz-box-sizing: border-box;
	height: auto;
	background-position: 410px 10px;
	-moz-box-sizing: border-box;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
}
/* buttons */
.tabbable > .nav-tabs > li > a {
	padding: 10px;
}
/* forms */
.wizard .hormenu li {
	float: none;
	display: block;
	width: auto;
	border: 2px solid #97400C;
	margin-bottom: 5px;
}
.wizard .hormenu li a {
	border: 0;
}
.wizard .hormenu li a.done {
	border: 0;
}
.wizard .hormenu {
	margin-bottom: 20px;
}
.wizard-inverse .hormenu li {
	border-color: #333;
}
.wizard .tabbedmenu {
	height: auto;
	padding: 10px;
}
.wizard .tabbedmenu li {
	display: block;
	margin-bottom: 10px;
}
.wizard .tabbedmenu li:last-child {
	margin-bottom: 0;
}
.wizard .tabbedmenu li a {
	padding: 10px;
}
#elm1_toolbargroup {
	width: 395px;
}
/* media */
.mediamgr_menu li.right {
	float: none;
	margin-top: 10px;
}
.mediamgr_category ul li.right {
	float: none;
	text-align: right;
	display: block;
	border-top: 1px dashed #ddd;
	margin-top: 10px;
}
.mediamgr .mediamgr_right {
	top: 110px;
}
.mediamgr_menu li.filesearch {
	margin: 10px 0;
	width: 100%;
}
.mediamgr_menu form input.filekeyword {
	width: 100%;
	-moz-box-sizing: border-box;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	height: auto;
	margin-bottom: 0;
}
.mediamgr_menu li.right {
	margin-top: 0;
}
.mediaWrapper {
	width: 280px;
}
/* table */
.dataTables_paginate .first, .dataTables_paginate .previous,  .dataTables_paginate .paginate_active, .dataTables_paginate .paginate_button,  .dataTables_paginate .next, .dataTables_paginate .last {
	padding: 5px 7px;
}
div.table-wrapper {
	margin-bottom: 0;
}
/* messages */
.messageleft {
	width: auto;
	float: none;
	height: auto;
}
.messageright {
	margin-left: 0;
	display: none;
	height: auto;
	border-left: 1px solid #97400C;
}
.messagesearch input {
	background-position: 375px 9px;
}
.msglist {
	height: auto;
	border-bottom-width: 1px;
}
.messageview {
	height: auto;
}
/* calendar */
.fc-button {
	padding: 0 5px;
}
.fc-header-title {
	margin-top: 3px;
}
/* invoice */
.amountdue h1 {
	padding: 10px 25px;
}
.amountdue .btn {
	width: 225px;
}
/* blog */
.gridblog li {
	width: 100%;
}
}
 @media screen and (max-width: 360px) {
.header {
	height: 90px;
}
.headmenu > li {
	font-size: 12px;
}
.headmenu > li > a {
	padding: 25px 5px 9px;
}
.headmenu > li > a .head-icon {
	width: 30px;
	height: 30px;
	background-size: cover;
}
.leftmenu .nav-tabs.nav-stacked li a {
	font-size: 13px;
}
.leftmenu .nav-tabs.nav-stacked .dropdown ul li a {
	font-size: 12px;
}
.userloggedinfo img {
	width: 60px;
}
.userloggedinfo .userinfo {
	top: 90px;
}
.header .logo {
	padding-top: 30px;
}
.headmenu .dropdown-menu:after {
	left: 25px;
}
.userloggedinfo .userinfo:after {
	right: 35px;
}
.searchbar input {
	background-position: 285px 10px;
}
/* buttons */
.tabbable > .nav-tabs > li {
	overflow: hidden;
	font-size: 11px;
}
.tabbable > .nav-tabs > li a {
	padding: 10px 5px;
}
.glyphicons li {
	width: auto;
	float: none;
}
.fontawesomeicons .span3 {
	width: auto;
	float: none;
}
.iconsweetslist li {
	width: auto;
	float: none;
}
/* forms */
.dualselect select {
	width: 38%;
}
.chzn-container {
	width: 270px !important;
}
.chzn-drop {
	width: 268px !important;
}
.chzn-search input {
	width: 220px !important;
}
.tagsinput {
	width: 260px !important;
}
#elm1_toolbargroup {
	width: 285px;
}
/* elements */
.navbar .brand {
	display: none;
} /* hidden for demo purposes only */
/* boxes */
.slide_img, .entry_img {
	float: none;
	margin-bottom: 10px;
}
.slide_content, .entry_content {
	margin-left: 0;
}
/* media */
.mediamgr_category ul li {
	float: none;
	display: block;
	margin: 0;
}
.mediamgr_menu li {
	margin-bottom: 10px;
}
.mediamgr_menu li.newfilebtn {
	margin-left: 10px;
}
.mediaWrapper {
	width: 240px;
}
.imgpreview {
	width: 209px;
}
/* messages */
.messagemenu ul {
	height: 45px;
}
.messagemenu ul li a {
	padding: 12px 10px;
}
/* calendar */
.fc-header {
	margin-top: 30px;
}
.fc-header-title h2 {
	margin-top: -50px;
}
.fc-button-month {
	margin-left: -50px;
}
/* error */
.errortitle h4 {
	font-size: 20px;
}
.errortitle span {
	font-size: 50px;
}
.errortitle span:first-child {
	margin-left: 0;
}
/* bootstrap */
.tabbable > .tab-content {
	padding: 15px;
}
.btn-circle {
	width: 6px;
}
.btn-circle i {
	margin-left: -3px;
}
.input-append .btn, .input-prepend .btn {
	padding-left: 8px;
	padding-right: 8px;
	font-size: 12px;
}
/* footer */
.footer .footer-left {
	float: none;
	text-align: center;
}
.footer .footer-right {
	float: none;
	text-align: center;
}
}
 @media screen and (max-width: 320px) {
body {
	font-size: 11px;
	line-height: 18px;
}
.leftpanel {
	width: 240px;
}
.header .logo {
	width: 240px;
}
.headmenu > li > a {
	padding: 25px 0 9px;
}
.searchbar input {
	background-position: 245px 10px;
}
.pagetitle h1 {
	font-size: 24px;
}
.pageicon {
	font-size: 32px;
	padding: 10px 5px;
}
.pagetitle {
	margin-left: 75px;
}
/* dashboard */
.shortcuts li a {
	width: 130px;
}
.shortcuts li:nth-child(even) {
	margin-right: 0;
}
.commentlist li img {
	width: 40px;
}
.commentlist li .comment-info {
	margin-left: 55px;
}
.commentlist li .comment-info h4 {
	font-size: 14px;
}
/* buttons */
.buttons-icons li {
	width: 50px;
	overflow: hidden;
}
.buttons-icons li a {
	width: 150px;
}
/* forms */
.stdform .input-append input, .stdform .input-prepend input {
	width: 100px !important;
}
#elm1_toolbargroup {
	width: 240px;
}
/* media */
.mediamgr_menu li.newfoldbtn {
	margin-left: 0;
	clear: left;
}
/* calendar */
.fc-button-month {
	margin-left: -90px;
}
.fc-header-title h2 {
	margin-left: -175px;
}
/* table */
.dataTables_paginate .first, .dataTables_paginate .previous,  .dataTables_paginate .paginate_active, .dataTables_paginate .paginate_button,  .dataTables_paginate .next, .dataTables_paginate .last {
	padding: 5px;
}
div.table-wrapper {
	margin-bottom: 0 !important;
	border-bottom: 1px solid #ddd;
}
.table-infinite tr th:nth-child(2),  .table-infinite tr td:nth-child(2),  .table-infinite tr th:nth-child(3),  .table-infinite tr td:nth-child(3) {
	display: none;
}
}

.leftpanel{
	/*background: #282828;*/
}

.logo a{
	color: #FFFFFF;
    float: left;
    font-size: 30px;
    height: 66px;
    overflow: hidden;
    width: 350px;
}

.logo span{
	float: left;
    font-size: 18px;
    font-weight: bold;
    margin-left: 115px;
    padding: 0;
    color: #000000;
    width: 100%;
}
/** SHK CHANGES **/

.btn-submit{
	background:#97400C !important;
	border:1px solid #97400C;
}

.nav-header nav{
	float: right;
}

#dyntable tr, #dyntable1 tr{
	cursor: pointer;
}

/* Pagenation CSS */
.table .sorting {
    background: url("../images/sort_both.png") no-repeat scroll right center #333;
}
.table .sorting_asc {
    background: url("../images/sort_asc.png") no-repeat scroll right center #333;
}
.table .sorting_desc {
    background: url("../images/sort_desc.png") no-repeat scroll right center #333;
}
/* Another CSS File */
.rstar{
	color: #ff0000;
    padding: 5px;
}

nav span {
        margin-left:10px;
      }

.ui-datepicker-month{
	width: 100px;
	margin-bottom: 5px !important;
}
.ui-datepicker-year{
	width: 100px;
	margin-left: 10px;
	margin-bottom: 5px !important;
}
.ui-datepicker-prev, .ui-datepicker-next{
	display: none;
}
.ui-datepicker-header{
	background: #97400C !important;
}
.ui-datepicker{
	border: 1px solid #97400C !important;
}


.stdformbutton input[type=submit]{
	margin-bottom: 5px;
	height:32px;

}

.shortcuts.report-content li {
    background: none repeat scroll 0 0 #97400C;
    color: #FFFFFF;
    display: block;
    font-size: 16px;
    height:auto;
    width: auto;
    padding: 5px;
}

.box p{
	width:auto;
	height: auto;
	float: left;
	padding: 5px;
	overflow: hidden;

}

.box p a{
	width:auto;
	height: auto;
	float: left;
	padding: 5px;

}

.lchild{
	float: right !important;
	margin-right: 10px;
}

/*----------------------------
    The file upload form
-----------------------------*/



#drop{
    background-color: #2E3134;
    padding: 40px 50px;
    margin-bottom: 30px;
    border: 20px solid rgba(0, 0, 0, 0);
    border-radius: 3px;
    border-image: url('../img/border-image.png') 25 repeat;
    text-align: center;
    text-transform: uppercase;

    font-size:16px;
    font-weight:bold;
    color:#7f858a;
}

#drop a{
    background-color:#007a96;
    padding:12px 26px;
    color:#fff;
    font-size:14px;
    border-radius:2px;
    cursor:pointer;
    display:inline-block;
    margin-top:12px;
    line-height:1;
}

#drop a:hover{
    background-color:#0986a3;
}

#drop input{
    display:none;
}

#upload ul{
    list-style:none;
    margin:0 -30px;
    border-top:1px solid #2b2e31;
    border-bottom:1px solid #3d4043;
}

#upload ul li{

    background-color:#333639;

    background-image:-webkit-linear-gradient(top, #333639, #303335);
    background-image:-moz-linear-gradient(top, #333639, #303335);
    background-image:linear-gradient(top, #333639, #303335);

    border-top:1px solid #3d4043;
    border-bottom:1px solid #2b2e31;
    padding:15px;
    height: 52px;

    position: relative;
}

#upload ul li input{
    display: none;
}

#upload ul li p{
    width: 144px;
    overflow: hidden;
    white-space: nowrap;
    color: #EEE;
    font-size: 16px;
    font-weight: bold;
    position: absolute;
    top: 20px;
    left: 100px;
}

#upload ul li i{
    font-weight: normal;
    font-style:normal;
    color:#7f7f7f;
    display:block;
}

#upload ul li canvas{
    top: 15px;
    left: 32px;
    position: absolute;
}

#upload ul li span{
    width: 15px;
    height: 12px;
    background: url('../img/icons.png') no-repeat;
    position: absolute;
    top: 34px;
    right: 33px;
    cursor:pointer;
}

#upload ul li.working span{
    height: 16px;
    background-position: 0 -12px;
}

#upload ul li.error p{
    color:red;
}
/* End */
.pat-innermain{
	//height: 860px;
	height: auto;
	display:block;

}

.export{
	margin: 5px;
}

.widgetbox{
    display: inline-block;
    height: 100%;
    margin-left: 5px;

}

.spanmap{
  background: none repeat scroll 0 0 #000000;
    border: 5px solid #97400C;
    display: block;
    height: 99%;
    margin-left: 5px;
}

.patinfoimg{
	background: none repeat scroll 0 0 #FFFFFF;
    border-left: 1px solid #DDDDDD;
    display: block;
    margin-left: 220px;
    padding: 15px;
    overflow: hidden;
}
.patinfoimg img {
	background: #97400C;
    float: left;
    padding: 3px;
    margin: 0 2px 10px 0;
    width: 80px;
    height: 80px;

  }
.patimg{
	float: left;
	width: 85px;
	margin: 5px;
}

#category-suggestions{
	width: 282px;
}
.suggestions{
	float: left;
	border-bottom: 1px solid #BBBBBB;
	border-left: 1px solid #BBBBBB;
	border-right: 1px solid #BBBBBB;
	width: 282px;
	margin-bottom: 5px;
}
.suggestions li{
	float: left;
	width: 282px;
	list-style: none;
	padding-left: 5px;
}

.jobautocomp{
	background: none repeat scroll 0 0 #FCFCFC;
    border-top: 1px solid #DDDDDD;
    clear: both;
    margin: 0;
}
.jobautocomp_job{
	background: none repeat scroll 0 0 #FCFCFC;
    border-top: 1px solid #DDDDDD;
    clear: both;
    margin: 0;
}
/* Custom JS */
.ui-helper-hidden-accessible {
    border: 0 none;
    clip: rect(0px, 0px, 0px, 0px);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
}
.ui-state-default .ui-icon {
    background-image: url("../images/ui-icons_888888_256x240.png");
}
.ui-button-icon-only .ui-icon {
    left: 50%;
    margin-left: -8px;
}
.ui-menu {
    list-style: none outside none;
    margin: 0;
    outline: medium none;
    padding: 2px;
}

.ui-menu .ui-menu-item a {
    display: block;
    font-weight: normal;
    line-height: 1.5;
    min-height: 0;
    padding: 2px 0.4em;
    text-decoration: none;
}

.custom-combobox {
position: relative;
display: inline-block;
}
.custom-combobox-toggle {
position: absolute;
top: 0;
bottom: 0;
margin-left: -1px;
padding: 0;
/* support: IE7 */
*height: 1.7em;
*top: 0.1em;
}
.custom-combobox-input {
margin: 0;
padding: 0.3em;
}
.operator-list{
float: left;
margin: 10px 25px;
}

.tooltip {
    display:none;
    background:transparent url("../images/black_arrow.png");
    font-size:12px;
    height:70px;
    width:160px;
    padding:25px;
    color:#eee;
  }
.jobassign p{
	border: none !important;
}

.jobassign{
	 margin-bottom: 3px !important;
    padding: 0 12px !important;
}

.jobassign label{
	padding: 4px 0 0 15px !important;
}
.intervent_fortnightly{
	width: 100% !important;
	margin: 0px;
	padding: 0px !important;
}
.total_int_div{
	border: 1px solid rgb(221, 221, 221); padding-left: 10px; margin-bottom: 5px; overflow: hidden;
}
.total_int_div_hide{
 	display:none; border: 1px solid rgb(221, 221, 221); padding-left: 10px; margin-bottom: 5px; overflow: hidden;
}

.opterrormsg{ width: 235px; border: 1px solid rgb(204, 204, 204); border-radius: 8px 8px 8px 8px; padding: 6px; margin-top: 5px; }

.opterrortitle { background: none repeat scroll 0 0 #95BCF2 !important; color: #FFFFFF; font-weight: bold; margin: 0; padding: 0 5px;  border-radius: 5px 5px 5px 5px; }
.opterrormsg ul{ list-style: none outside none; font-size: 11px; }
.opterrormsg ul li{ border-bottom: 1px solid #000000; }
  .optbox{
        	height: 435px;
        }
.add_copy_job{
	float: left; margin-left: 12px;
}
.navbtn{
	float: left;margin-left: 15px;
}

.navbtn .scrollbar{
	float: left; /* margin-left: 45px;*/
}
.navbtn .navicon{
	float: left; margin-left: 10px;
}
.contractcom{
	border: 1px solid rgb(221, 221, 221); padding-left: 10px; margin-bottom: 5px; width: 100%; overflow: hidden; float: left;
}
.cursorpoint tr{
	cursor: default !important;
}
.tooltip {
    display: none;
    font-size: 10pt;
    position: absolute;
    border: 1px solid #000000;
    background-color: #FFFFE0;
    padding: 2px 6px;
    color: Green;
    font-weight: bold;
    opacity: 1;
    width: auto;
    height: auto;
}
.boxtime{
	float: left;
}

.boxdots{
   	float: left;
   }
@media screen and (min-width: 1280px) {
	.boxname{
	float: left;
    margin-left: 2px;
    overflow: hidden;
    width: 48%;
    height: 21px;
   }
   .boxdots{
   	display: none;
   }
}
@media (min-width: 321px) and (max-width: 1279px) {
	.boxname{
	float: left;
    margin-left: 2px;
    overflow: hidden;
    width: 25%;
    height: 21px;
   }
   .boxdots{
   	display: block;
   		float: left;
   }
}
.jobpatientlist li{
	list-style: none outside none;
}


/* Light box */

/* Preload images */
body:after {
  content: url(../images/close.png) url(../images/loading.gif) url(../images/prev.png) url(../images/next.png);
  display: none;
}

.lightboxOverlay {
  position: absolute;
  top: 0;
  left: 0;
  z-index: 9999;
  background-color: black;
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=80);
  opacity: 0.8;
  display: none;
}

.lightbox {
  position: absolute;
  left: 0;
  width: 100%;
  z-index: 10000;
  text-align: center;
  line-height: 0;
  font-weight: normal;
}

.lightbox .lb-image {
  display: block;
  height: auto;
  max-width: inherit;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  -ms-border-radius: 3px;
  -o-border-radius: 3px;
  border-radius: 3px;
}

.lightbox a img {
  border: none;
}

.lb-outerContainer {
  position: relative;
  background-color: white;
  *zoom: 1;
  width: 250px;
  height: 250px;
  margin: 0 auto;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  -ms-border-radius: 4px;
  -o-border-radius: 4px;
  border-radius: 4px;
}

.lb-outerContainer:after {
  content: "";
  display: table;
  clear: both;
}

.lb-container {
  padding: 4px;
}

.lb-loader {/* Preload images */
body:after {
  content: url(../images/close.png) url(../images/loading.gif) url(../images/prev.png) url(../images/next.png);
  display: none;
}

.lightboxOverlay {
  position: absolute;
  top: 0;
  left: 0;
  z-index: 9999;
  background-color: black;
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=80);
  opacity: 0.8;
  display: none;
}

.lightbox {
  position: absolute;
  left: 0;
  width: 100%;
  z-index: 10000;
  text-align: center;
  line-height: 0;
  font-weight: normal;
}

.lightbox .lb-image {
  display: block;
  height: auto;
  max-width: inherit;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  -ms-border-radius: 3px;
  -o-border-radius: 3px;
  border-radius: 3px;
}

.lightbox a img {
  border: none;
}

.lb-outerContainer {
  position: relative;
  background-color: white;
  *zoom: 1;
  width: 250px;
  height: 250px;
  margin: 0 auto;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  -ms-border-radius: 4px;
  -o-border-radius: 4px;
  border-radius: 4px;
}

.lb-outerContainer:after {
  content: "";
  display: table;
  clear: both;
}

.lb-container {
  padding: 4px;
}

.lb-loader {
  position: absolute;
  top: 43%;
  left: 0;
  height: 25%;
  width: 100%;
  text-align: center;
  line-height: 0;
}

.lb-cancel {
  display: block;
  width: 32px;
  height: 32px;
  margin: 0 auto;
  background: url(../images/loading.gif) no-repeat;
}

.lb-nav {
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
  z-index: 10;
}

.lb-container > .nav {
  left: 0;
}

.lb-nav a {
  outline: none;
  background-image: url('data:image/gif;base64,R0lGODlhAQABAPAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==');
}

.lb-prev, .lb-next {
  height: 100%;
  cursor: pointer;
  display: block;
}

.lb-nav a.lb-prev {
  width: 34%;
  left: 0;
  float: left;
  background: url(../images/prev.png) left 48% no-repeat;
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=0);
  opacity: 0;
  -webkit-transition: opacity 0.6s;
  -moz-transition: opacity 0.6s;
  -o-transition: opacity 0.6s;
  transition: opacity 0.6s;
}

.lb-nav a.lb-prev:hover {
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100);
  opacity: 1;
}

.lb-nav a.lb-next {
  width: 64%;
  right: 0;
  float: right;
  background: url(../images/next.png) right 48% no-repeat;
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=0);
  opacity: 0;
  -webkit-transition: opacity 0.6s;
  -moz-transition: opacity 0.6s;
  -o-transition: opacity 0.6s;
  transition: opacity 0.6s;
}

.lb-nav a.lb-next:hover {
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100);
  opacity: 1;
}

.lb-dataContainer {
  margin: 0 auto;
  padding-top: 5px;
  *zoom: 1;
  width: 100%;
  -moz-border-radius-bottomleft: 4px;
  -webkit-border-bottom-left-radius: 4px;
  border-bottom-left-radius: 4px;
  -moz-border-radius-bottomright: 4px;
  -webkit-border-bottom-right-radius: 4px;
  border-bottom-right-radius: 4px;
}

.lb-dataContainer:after {
  content: "";
  display: table;
  clear: both;
}

.lb-data {
  padding: 0 4px;
  color: #ccc;
}

.lb-data .lb-details {
  width: 85%;
  float: left;
  text-align: left;
  line-height: 1.1em;
}

.lb-data .lb-caption {
  font-size: 13px;
  font-weight: bold;
  line-height: 1em;
}

.lb-data .lb-number {
  display: block;
  clear: left;
  padding-bottom: 1em;
  font-size: 12px;
  color: #999999;
}

.lb-data .lb-close {
  display: block;
  float: right;
  width: 30px;
  height: 30px;
  background: url(../images/close.png) top right no-repeat;
  text-align: right;
  outline: none;
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=70);
  opacity: 0.7;
  -webkit-transition: opacity 0.2s;
  -moz-transition: opacity 0.2s;
  -o-transition: opacity 0.2s;
  transition: opacity 0.2s;
}

.lb-data .lb-close:hover {
  cursor: pointer;
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100);
  opacity: 1;
}

  position: absolute;
  top: 43%;
  left: 0;
  height: 25%;
  width: 100%;
  text-align: center;
  line-height: 0;
}

.lb-cancel {
  display: block;
  width: 32px;
  height: 32px;
  margin: 0 auto;
  background: url(../images/loading.gif) no-repeat;
}

.lb-nav {
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
  z-index: 10;
}

.lb-container > .nav {
  left: 0;
}

.lb-nav a {
  outline: none;
  background-image: url('data:image/gif;base64,R0lGODlhAQABAPAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==');
}/* Preload images */
body:after {
  content: url(../images/close.png) url(../images/loading.gif) url(../images/prev.png) url(../images/next.png);
  display: none;
}

.lightboxOverlay {
  position: absolute;
  top: 0;
  left: 0;
  z-index: 9999;
  background-color: black;
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=80);
  opacity: 0.8;
  display: none;
}

.lightbox {
  position: absolute;
  left: 0;
  width: 100%;
  z-index: 10000;
  text-align: center;
  line-height: 0;
  font-weight: normal;
}

.lightbox .lb-image {
  display: block;
  height: auto;
  max-width: inherit;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  -ms-border-radius: 3px;
  -o-border-radius: 3px;
  border-radius: 3px;
}

.lightbox a img {
  border: none;
}

.lb-outerContainer {
  position: relative;
  background-color: white;
  *zoom: 1;
  width: 250px;
  height: 250px;
  margin: 0 auto;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  -ms-border-radius: 4px;
  -o-border-radius: 4px;
  border-radius: 4px;
}

.lb-outerContainer:after {
  content: "";
  display: table;
  clear: both;
}

.lb-container {
  padding: 4px;
}

.lb-loader {
  position: absolute;
  top: 43%;
  left: 0;
  height: 25%;
  width: 100%;
  text-align: center;
  line-height: 0;
}

.lb-cancel {
  display: block;
  width: 32px;
  height: 32px;
  margin: 0 auto;
  background: url(../images/loading.gif) no-repeat;
}

.lb-nav {
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
  z-index: 10;
}

.lb-container > .nav {
  left: 0;
}

.lb-nav a {
  outline: none;
  background-image: url('data:image/gif;base64,R0lGODlhAQABAPAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==');
}

.lb-prev, .lb-next {
  height: 100%;
  cursor: pointer;
  display: block;
}

.lb-nav a.lb-prev {
  width: 34%;
  left: 0;
  float: left;
  background: url(../images/prev.png) left 48% no-repeat;
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=0);
  opacity: 0;
  -webkit-transition: opacity 0.6s;
  -moz-transition: opacity 0.6s;
  -o-transition: opacity 0.6s;
  transition: opacity 0.6s;
}

.lb-nav a.lb-prev:hover {
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100);
  opacity: 1;
}

.lb-nav a.lb-next {
  width: 64%;
  right: 0;
  float: right;
  background: url(../images/next.png) right 48% no-repeat;
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=0);
  opacity: 0;
  -webkit-transition: opacity 0.6s;
  -moz-transition: opacity 0.6s;
  -o-transition: opacity 0.6s;
  transition: opacity 0.6s;
}

.lb-nav a.lb-next:hover {
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100);
  opacity: 1;
}

.lb-dataContainer {
  margin: 0 auto;
  padding-top: 5px;
  *zoom: 1;
  width: 100%;
  -moz-border-radius-bottomleft: 4px;
  -webkit-border-bottom-left-radius: 4px;
  border-bottom-left-radius: 4px;
  -moz-border-radius-bottomright: 4px;
  -webkit-border-bottom-right-radius: 4px;
  border-bottom-right-radius: 4px;
}

.lb-dataContainer:after {
  content: "";
  display: table;
  clear: both;
}

.lb-data {
  padding: 0 4px;
  color: #ccc;
}

.lb-data .lb-details {
  width: 85%;
  float: left;
  text-align: left;
  line-height: 1.1em;
}

.lb-data .lb-caption {
  font-size: 13px;
  font-weight: bold;
  line-height: 1em;
}

.lb-data .lb-number {
  display: block;
  clear: left;
  padding-bottom: 1em;
  font-size: 12px;
  color: #999999;
}

.lb-data .lb-close {
  display: block;
  float: right;
  width: 30px;
  height: 30px;
  background: url(../images/close.png) top right no-repeat;
  text-align: right;
  outline: none;
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=70);
  opacity: 0.7;
  -webkit-transition: opacity 0.2s;
  -moz-transition: opacity 0.2s;
  -o-transition: opacity 0.2s;
  transition: opacity 0.2s;
}

.lb-data .lb-close:hover {
  cursor: pointer;
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100);
  opacity: 1;
}


.lb-prev, .lb-next {
  height: 100%;
  cursor: pointer;
  display: block;
}

.lb-nav a.lb-prev {
  width: 34%;
  left: 0;
  float: left;
  background: url(../images/prev.png) left 48% no-repeat;
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=0);
  opacity: 0;
  -webkit-transition: opacity 0.6s;
  -moz-transition: opacity 0.6s;
  -o-transition: opacity 0.6s;
  transition: opacity 0.6s;
}

.lb-nav a.lb-prev:hover {
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100);
  opacity: 1;
}

.lb-nav a.lb-next {
  width: 64%;
  right: 0;
  float: right;
  background: url(../images/next.png) right 48% no-repeat;
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=0);
  opacity: 0;
  -webkit-transition: opacity 0.6s;
  -moz-transition: opacity 0.6s;
  -o-transition: opacity 0.6s;
  transition: opacity 0.6s;
}

.lb-nav a.lb-next:hover {
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100);
  opacity: 1;
}

.lb-dataContainer {
  margin: 0 auto;
  padding-top: 5px;
  *zoom: 1;
  width: 100%;
  -moz-border-radius-bottomleft: 4px;
  -webkit-border-bottom-left-radius: 4px;
  border-bottom-left-radius: 4px;
  -moz-border-radius-bottomright: 4px;
  -webkit-border-bottom-right-radius: 4px;
  border-bottom-right-radius: 4px;
}

.lb-dataContainer:after {
  content: "";
  display: table;
  clear: both;
}

.lb-data {
  padding: 0 4px;
  color: #ccc;
}

.lb-data .lb-details {
  width: 85%;
  float: left;
  text-align: left;
  line-height: 1.1em;
}

.lb-data .lb-caption {
  font-size: 13px;
  font-weight: bold;
  line-height: 1em;
}

.lb-data .lb-number {
  display: block;
  clear: left;
  padding-bottom: 1em;
  font-size: 12px;
  color: #999999;
}

.lb-data .lb-close {
  display: block;
  float: right;
  width: 30px;
  height: 30px;
  background: url(../images/close.png) top right no-repeat;
  text-align: right;
  outline: none;
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=70);
  opacity: 0.7;
  -webkit-transition: opacity 0.2s;
  -moz-transition: opacity 0.2s;
  -o-transition: opacity 0.2s;
  transition: opacity 0.2s;
}

.lb-data .lb-close:hover {
  cursor: pointer;
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100);
  opacity: 1;
}
/* Light box */

.error_msg{
	color: red;
}
.pry_oper_user_icon {
	background: url(../images/icons/pry_blue.png) no-repeat;
	height:18px;
	width:18px;
	padding-bottom:4px; 
	float:right;
	
}
.sec_oper_user_icon {
	background: url(../images/icons/sec_green.png) no-repeat;
	height:18px;
	width:18px;
	padding-bottom:4px;
	float:right;
	
}
.checkboxoperator{ 
      width: 260px; 
      border: 1px solid rgb(204, 204, 204); 
      border-radius: 8px 8px 8px 8px; 
      padding: 6px; 
      margin-top: 5px; 
      overflow-y: scroll;
      height:200px;
}
.checkboxoperator ul{ 
      list-style: none outside none; 
      font-size: 11px; 
}
.checkboxoperator ul li{ 
      border-bottom: 1px solid #000000; 
}
#selecctall {
      margin:auto;
      width:152px;
      margin-left:219px;
      background:#97400C;
      border-color:#97400C;
      color: #fff; 

}
#deselecctall {
      margin:auto;
      width:152px;

}
.flash {
background-color: #fff;
font-weight:bold;
font-size:20px;-moz-border-radius: 6px;-webkit-border-radius: 6px;

}

