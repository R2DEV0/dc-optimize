import React, { useState, useEffect } from 'react';
import axios from 'axios';
import Dashboard from './Dashboard';
import DCQuestioning from './DCQuestioning';
import DCAP from './DCAP';
import DCQ3Cards from './DCQ3Cards';
import DCVirtual from './DCVirtual';

const App = () => {

    //#region Universal Variables
    const[showDashboard, setShowDashboard] = useState(true);
    const[showDCAP, setShowDCAP] = useState(false);
    const[showDCQuestioning, setShowDCQuestioning] = useState(false);
    const[showDCQ3Cards, setShowDCQ3Cards] = useState(false);
    const[showDCVirtual, setShowDCVirtual] = useState(false);
    const[spanish, setSpanish] = useState(false);
    const[spanishAuth, setSpanishAuth] = useState(false);
    const[printing, setPrinting] = useState(false);
    //#endregion

    //#region SpanishAuth?
    useEffect(() => {
        const authCheck = async () => {
            const res = await axios.get(wpData.ajaxurl + '?action=spanish_auth');
            if(res.data.message === "success"){
                if(res.data.data){
                    setSpanishAuth(true);
                };
            } else{
                console.log("Something went wrong.");
            };
        };
        setSpanishAuth(authCheck);
    }, []);
    //#endregion

    //#region DCAP Variables
    const [hide1, setHide1] = useState(true);
    const [hide2, setHide2] = useState(false);
    const [hide3, setHide3] = useState(true);
    //#endregion

    //#region StartSaveProcessDCQuestioning
    const handleOpenSaveAsShow = () => {
        setOpenSaveAs(true);
        setSaveFileName("");
    };
    //#endregion

    //#region ChangeView
    const ChangeView = (e) => {
        if(e.target.value == 1){
            setShowDashboard(false);
            setShowDCAP(true);
            setShowDCQuestioning(false);
            setShowDCQ3Cards(false);
            setShowDCVirtual(false);
            setSpanish(false);
        } else if(e.target.value == 2){
            setShowDashboard(false);
            setShowDCAP(false);
            setShowDCQuestioning(true);
            setShowDCQ3Cards(false);
            setShowDCVirtual(false);
            setSpanish(false);
        } else if(e.target.value == 3){
            setShowDashboard(false);
            setShowDCAP(false);
            setShowDCQuestioning(false);
            setShowDCQ3Cards(true);
            setShowDCVirtual(false);
            setSpanish(false);
        } else if(e.target.value == 4){
            setShowDashboard(false);
            setShowDCAP(false);
            setShowDCQuestioning(false);
            setShowDCQ3Cards(false);
            setShowDCVirtual(true);
            setSpanish(false);
        } else if(e.target.value == 5){ // Q3 Cards - Spanish
            setShowDashboard(false);
            setShowDCAP(false);
            setShowDCQuestioning(false);
            setShowDCQ3Cards(true);
            setShowDCVirtual(false);
            setSpanish(true);
        } else {
            setShowDashboard(true);
            setShowDCAP(false);
            setShowDCQuestioning(false);
            setShowDCQ3Cards(false);
            setShowDCVirtual(false);
            setSpanish(false);
        }
    }
    //#endregion

    return (
        <div className='col-12 mt-3 mb-5'>

            <select className={showDashboard ? 'form-control glowSelect col-lg-5 col-md-6 col-sm-12' : 'form-control col-lg-4 col-md-6 col-sm-12'} onChange={(e) => ChangeView(e)}>                  
                <option value={0}>Dashboard</option>
                <option value={1}>DCAP Differentiation Task Statement Software</option>
                <option value={2}>Q4 Question Creator Software</option>
                <option value={4}>DC & CI Cards and Posters</option>
                <option value={3}>Virtual Q3 Question Stem Cards</option>
                { spanishAuth && <option value={5}>Virtual Q3 Question Stem Cards - Spanish</option> }
            </select>

            { showDashboard &&
                <Dashboard />
            }

            { showDCAP &&
                <DCAP hide1={hide1} setHide1={setHide1} hide2={hide2} setHide2={setHide2} hide3={hide3} setHide3={setHide3} 
                    printing={printing} setPrinting={setPrinting} />
            }

            { showDCQuestioning &&
                <DCQuestioning  printing={printing} setPrinting={setPrinting} />
            }

            { showDCQ3Cards &&
                <DCQ3Cards spanish={spanish} spanishAuth={spanishAuth} />
            }

            { showDCVirtual &&
                <DCVirtual />
            }

        </div>
    )
};

export default App;