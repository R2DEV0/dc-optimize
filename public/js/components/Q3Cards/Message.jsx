import React from 'react';


const Message = (props) => {
    const{rolled, setRolled, accept, acceptLit, spanish} = props;

    const rollAgain = () => {
        setRolled(false);
    };

    return(
        <div className='mt-3'>
            {rolled &&
                <>
                    <div className='col-12 text-center'>
                        <button className='col-md-8 col-sm-12 mt-1 btn btn-primary btn-md' onClick={accept}>Virtual Q<span style={{fontSize:'15px'}}>3</span> Question Stems</button>
                        {!spanish && <button className='col-md-8 col-sm-12 mt-2 btn btn-success btn-md' onClick={acceptLit}>Responding to Literature Questions</button> }
                        <button className='col-md-8 col-sm-12 mt-2 btn btn-outline-danger btn-md' onClick={rollAgain}>{spanish ? "Comenzar de nuevo" : "Start Over"}</button>
                    </div>
                </>
            }
        </div>
    )
};

export default Message;