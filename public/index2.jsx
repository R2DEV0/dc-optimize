import * as React from "react";
import * as ReactDOM from "react-dom";
import Slides from './js/views/Slides';

function Index2() {
    return(
        <Slides />
    )
}

ReactDOM.render(<Index2 />, document.getElementById('dc-slides'));