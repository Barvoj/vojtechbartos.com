import "../css/style.less";
import $ from "jquery";
import "bootstrap/dist/js/bootstrap.js";
import "./nette.ajax.js";
import "./history.nette.ajax.js";
import "./netteForms.js";
import "./modal.js";
import "./progress.js";
import React from "react";
import ReactDOM from "react-dom";

$.nette.init();

class HelloMessage extends React.Component {
    render() {
        return <div>Hello {this.props.name}</div>;
    }
}

ReactDOM.render(<HelloMessage name="John" />, document.getElementById("react-app"));
