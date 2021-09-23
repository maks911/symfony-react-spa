import React, {Component} from 'react';
import {Route, Switch,Redirect} from 'react-router-dom';
import Menu from "./Menu";
import Features from "./Features";
import Benefits from "./Benefits";
import TopScreen from "./TopScreen";
import Proxy from "./Proxy";

class Home extends Component {

    render() {
        return (
            <div>
                <Menu/>
                <Switch>
                    <Redirect exact from="/" to="/top" />
                    <Route path="/features" component={Features} />
                    <Route path="/benefits" component={Benefits} />
                    <Route path="/top" component={TopScreen} />
                    <Route path="/proxy" component={Proxy} />
                </Switch>
            </div>
        )
    }
}

export default Home;