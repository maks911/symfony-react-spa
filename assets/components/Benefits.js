import React, {Component} from 'react';
import axios from 'axios';
import ListEl from "./ListEl";

class Benefits extends Component {
    constructor(props) {
        super(props);
        this.state = { data: {benefits: []}, loading: false};
    }

    componentDidMount() {
        this.getBenefits();
    }

    render() {
        return(
            <div className="section benefits white">
                <div className="container">
                    <div className="list aos-init aos-animate" data-aos="fade-up">
                        {this.state.data.benefits.map(benefit =>
                            <ListEl key={benefit.id} feature={benefit} />
                        )}
                    </div>
                </div>
            </div>
        )
    }

    getBenefits() {
        axios.get(`http://127.0.0.1:8000/api/benefits`).then(benefits => {
            console.log(benefits);
            this.setState({
                data: benefits.data,
                loading: true
            })
        })
    }
}

export default Benefits;