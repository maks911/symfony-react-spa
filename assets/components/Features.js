import React, {Component} from 'react';
import axios from 'axios';
import ListEl from './ListEl';

class Features extends Component {
    constructor(props) {
        super(props);
        this.state = {data: {features: [], title: ''}, loading: true};
    }

    componentDidMount() {
        this.getFeatures();
    }

    render() {
        return (
            <div id="1" className="section benefits pink">
                <div className="container">
                    <h2 className="title aos-init aos-animate" data-aos="fade-right"
                        dangerouslySetInnerHTML={{__html: this.state.data.title}}/>
                    <div className="list aos-init aos-animate" data-aos="fade-up">
                        {this.state.data.features.map(feature =>
                            <ListEl key={feature.id} feature={feature} />
                        )}
                    </div>
                </div>
            </div>
        )
    }

    getFeatures() {
        axios.get(`http://127.0.0.1:8000/api/features`).then(features => {
            console.log(features);
            this.setState({
                data: features.data,
                loading: true
            })
        })
    }
}

export default Features;