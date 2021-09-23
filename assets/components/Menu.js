import React, {Component} from 'react';
import {Link} from 'react-router-dom';
import axios from "axios";
import Icons from './Icons';

class Menu extends Component {

    constructor(props) {
        super(props);
        this.state = { menu: [], loading: true, bodyClass: 'wrapper'};
    }

    render() {
        return (
            <header className="header">
                <div className={`container ${this.state.bodyClass}`}>
                    <div className="header__inner nav-line">
                        <Link className="logo" to="/">
                            <Icons name="B2Broker_logo" className="header__logo" width="141" height="31"/>
                        </Link>
                        <ul className="nav">
                            {this.state.menu.map(menuItem =>
                                <li onClick={() => this.changeBodyClass()} key={menuItem.id} className="nav__item js-anchor menu-item menu-item-type-custom menu-item-object-custom">
                                    <Link className={"nav__item__link"} to={menuItem.link}>
                                        {menuItem.name}
                                    </Link>
                                </li>
                            )}
                        </ul>
                    </div>
                </div>
            </header>
        )
    }

    componentDidMount() {
        this.getMenu();
    }

    getMenu() {
        axios.get(`http://127.0.0.1:8000/api/menu`).then(menu => {
            this.setState({menu: menu.data, loading: false})
        })
        this.changeBodyClass();
    }

    getLangs() {
        axios.get(`http://127.0.0.1:8000/api/langs`).then(menu => {
            this.setState({menu: menu.data, loading: false})
        })
    }

    changeBodyClass() {
        if (window.location.href.indexOf('/proxy') > -1) {
            this.setState({bodyClass: 'proxy-wrapper'})
        } else {
            this.setState({bodyClass: 'usual-wrapper'})
        }
    }
}

export default Menu;