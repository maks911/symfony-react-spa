import React, {Component} from 'react';
import BubleIcon from '../images/svg-inline/buble.svg';
import BubleIconLittle from '../images/svg-inline/buble-little.svg';
import { LazyLoadImage } from 'react-lazy-load-image-component';
import axios from "axios";

class TopScreen extends Component {
    constructor(props) {
        super(props);
        this.state = {data: [], loading: false};
    }

    componentDidMount() {
        this.getFields();
    }

    render() {
        return (
            <div className="section main-screen aos-init aos-animate" data-aos="fade-in">
                <div className="container main-screen__inner">
                    <div className="main-screen__text aos-init aos-animate" data-aos="fade-up">
                        <h2 className="title" dangerouslySetInnerHTML={{ __html: this.state.data.title }} />
                        <div className="subtitle" dangerouslySetInnerHTML={{ __html: this.state.data.subtitle }} />
                    </div>
                    <div className="main-screen__form">
                        <LazyLoadImage
                            src={BubleIcon}
                            className="buble-big"
                            alt="buble"
                            effect="blur"
                        />
                        <LazyLoadImage
                            src={BubleIconLittle}
                            className="buble-little"
                            alt="buble"
                            effect="blur"
                        />
                    </div>
                </div>
            </div>
        )
    }

    getFields() {
        axios.get(`http://127.0.0.1:8000/api/top`).then(top => {
            this.setState({data: top.data, loading: true})
        })
    }
}

export default TopScreen;