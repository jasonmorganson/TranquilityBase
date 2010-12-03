

#menu,
#band,
#wrapper,
#banner,
#header,
#container,
#main-container,
#footer {
	margin-left:  auto;
	margin-right: auto;
}

#content,
#sidebar-left,
#sidebar-right,
#content-container,
#sidebar-left-container,
#sidebar-right-container {
	position:relative;
}


#sidebar-right-container {
	overflow: hidden;
}


#content-container,
#sidebar-left-container,
#sidebar-right-container {
	width:100%;
}

#header #title {
	position: relative;
}

#header #title #name {
	position: absolute;
	bottom: 0px;
	left: 0px;
}

#header #title #description {
	position: absolute;
	bottom: 0px;
	right: 0px;
}



#main-container,
#content-container,
#sidebar-left-container,
#sidebar-right-container {
	float: left;
}

#sidebar-left {
	float: left;
}

#content {
	float: left;
}

#content[class="left-only"] {
	float: right;
}

#sidebar-right {
	float: right;
}

#footer {
	clear: both;
}

#content ul li {
	list-style: disc;
}

hr {
	clear: both;
	margin-left:  auto;
	margin-right: auto;
}

dl {
	width: 100%;
	float: left;
	clear: both;
}

dt {
	width: 30%;
	float: left;
	clear: left;
}

dd {
	width: 70%;
	float: right;
	clear: right;
}

dt {
	font-weight: bold;
}

dt:after {
	content: ":";
}


.alignright {
	float:right;
}

.alignleft {
	float:left;
}

.aligncenter {
	margin-left: auto;
	margin-right: auto;
}

.wp-caption-text {
	clear: both;
	margin: 0;
	text-align: center;
	font-style: italic;
}
