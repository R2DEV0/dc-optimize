import React from 'react';

const DoubleButton = (props) => {
    const{twoDice, oneDice, one, spanish} = props;

    return(
        <div>
            { one 
                ?
                <a className='dc-button-link' onClick={twoDice}>{ spanish ? "Utilice dos iconos" : "Use Two Icons"}</a> 
                :
                <a className='dc-button-link' onClick={oneDice}>{spanish ? "Utilice un icono" : "Use One Icon"}</a>
            }
        </div>
    )
};

export default DoubleButton;