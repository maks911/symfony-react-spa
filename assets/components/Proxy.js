import React, {Component} from 'react';
import axios from 'axios';
import {LazyLoadImage} from 'react-lazy-load-image-component';

class Proxy extends Component {
    constructor(props) {
        super(props);
        this.state = {data: [], loading: false};
    }

    componentDidMount() {
        this.getProxy();
    }

    render() {
        return (
            <div className="section sidebanner-button Proxy" style={{backgroundColor: '#181927'}}>
                <div className="container">
                    <div className="inner">
                        <div className="col aos-init aos-animate" data-aos="fade-right">
                            <h2 className="title">
                                {this.state.data.title}
                            </h2>
                            <div className="description">
                                {this.state.data.description}
                            </div>
                            <a className="button" href={this.state.data.link}>
                                {this.state.data.link_text}
                                <span className="button-icon">
                                    <svg width="7" height="11" viewBox="0 0 7 11" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path fillRule="evenodd" clipRule="evenodd"
                                              d="M6.42676 5.6641L2.21607 0.960651C1.87888 0.583998 1.28917 0.583998 0.951978 0.960651C0.663849 1.2825 0.663585 1.76946 0.951365 2.09162L4.1426 5.6641L0.951366 9.23658C0.663586 9.55875 0.663849 10.0457 0.951978 10.3676C1.28917 10.7442 1.87888 10.7442 2.21607 10.3676L6.42676 5.6641Z"
                                              fill="black" fillOpacity="0.7">
                                        </path>
                                    </svg>
                                </span>
                            </a>
                        </div>
                        <div className="col banner_right aos-init aos-animate" data-aos="fade-left">
                            <LazyLoadImage
                                src={this.state.data.image}
                                className="banner"
                                alt=""
                                effect="blur"
                            />
                        </div>
                    </div>
                </div>
            </div>
        )
    }

    getProxy() {
        axios.get(`http://127.0.0.1:8000/api/proxy`).then(proxy => {
            this.setState({
                data: proxy.data,
                loading: true
            })
        })
    }
}

export default Proxy;