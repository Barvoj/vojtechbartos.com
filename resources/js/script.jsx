import 'bootstrap/dist/css/bootstrap.css';
// import $ from 'jquery/dist/jquery.js';
jQuery = require("jquery");
import 'bootstrap/dist/js/bootstrap.js';
import '../css/style.less';

import React from 'react';
import ReactDOM from 'react-dom';


class HelloMessage extends React.Component {
    render() {
        return <div>Hello {this.props.name}</div>;
    }
}

ReactDOM.render(<HelloMessage name="John" />, document.getElementById("react-app"));
