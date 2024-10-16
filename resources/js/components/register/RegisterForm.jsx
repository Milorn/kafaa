import { Field, Form, Formik } from "formik";
import { useRef, useState } from "react"
import RegisterExpert from "./RegisterExpert";
import RegisterCompany from "./RegisterCompany";
import RegisterProvider from "./RegisterProvider";
import axios from "axios";
import Spinner from "../ui/Spinner";

export default function RegisterForm() {
    const [type, setType] = useState('');
    const [label, setLabel] = useState('');
    const [submitting, setSubmitting] = useState(false);
    const [charter, setCharter] = useState(false);
    const [conditions, setConditions] = useState(false);
    const formContainer = useRef();
    const [error, setError] = useState(false);

    const [expert, setExpert] = useState({
        fname: "", lname: "", wilaya: "", address: "", phone: "", email: "", password: "",
        diploma: "", years_of_experience: "", number_of_projects: "", number_of_metric: "",
        professional_status: "", resumee: ""
    });
    const [company, setCompany] = useState({
        company_name: "", address: "", phone: "", email: "", website: "",
        responsible_name: "", responsible_job: "", activity_area: "", registry: "",
        employees: []
    });
    const [provider, setProvider] = useState({
        provider_name: "", address: "", phone: "", email: "", password: "",
        website: "", responsible_name: "", responsible_job: "", activity_area: "", registry: "",
    });

    const [errors, setErrors] = useState({ expert: {}, company: {}, provider: {} });

    const clearErrors = (type, name) => {
        const obj = { ...errors };
        obj[type][name] = null;
        setErrors(obj);
    };

    const submit = (e) => {
        e.preventDefault();

        if(submitting) return;

        setSubmitting(true);
        setError(false);

        let data = {};

        if (type == 'expert') {
            data = { type, ...expert, label };
        }
        else if (type == 'company') {
            data = { type, ...company };
        }
        else {
            data = {type, ...provider};
        }

        axios.postForm('/register', data)
            .then(() => window.location.href = "/app/login")
            .catch(err => {
                if (err.response.status == 422) {
                    const errors = {};
                    Object.keys(err.response.data.errors)
                        .forEach(key => errors[key] = err.response.data.errors[key][0]);
                    setErrors({expert: {}, provider: {}, company: {}, [type]: errors });
                    formContainer.current.scrollIntoView();
                }
                else {
                    setError(true);
                }
            }).finally(() => setSubmitting(false));
    };

    return (
        <>
            <form onSubmit={submit} ref={formContainer}>
                <div className="flex flex-col gap-7 px-6 py-12 bg-[#F8F8F8] rounded-lg shadow-bottom">
                    <div className="fieldset">
                        <label htmlFor="type">Vous représentez :</label>
                        <div className="relative">
                            <select id="type" className="w-full shadow-bottom" onChange={(e) => setType(e.target.value)} defaultValue={type} required>
                                <option value="" disabled>Please select</option>
                                <option value="expert">Installateur</option>
                                <option value="company">Entreprise</option>
                                <option value="provider">Fournisseur</option>
                            </select>
                            <svg className="pointer-events-none absolute top-0 right-0 mt-3 mr-3" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </div>

                    {
                        type == "expert" &&
                        <div className="fieldset">
                            <label htmlFor="label">Choisissez un label :</label>
                            <div className="relative">
                                <select id="label" className="w-full shadow-bottom" onChange={(e) => setLabel(e.target.value)} defaultValue={label} required>
                                    <option value="" disabled>Please select</option>
                                    <option value="epe">EPE</option>
                                    <option value="pv">PV</option>
                                </select>
                                <svg className="pointer-events-none absolute top-0 right-0 mt-3 mr-3" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </div>
                        </div>
                    }
                </div>
                {
                    type &&
                    <div className="mt-10">
                        {
                            type == 'company' ? <RegisterCompany company={company} setCompany={setCompany} errors={errors.company} clearErrors={clearErrors} />
                                : type == 'provider' ? <RegisterProvider provider={provider} setProvider={setProvider} errors={errors.provider} clearErrors={clearErrors} />
                                    : type == 'expert' && label && <RegisterExpert label={label} expert={expert} setExpert={setExpert} errors={errors.expert} clearErrors={clearErrors} />
                        }
                    </div>
                }

                <hr className="my-7" />

                <div className="flex flex-col gap-y-5">
                    <div className="flex items-center gap-3">
                        <input id="charter" type="checkbox" onChange={(e) => setCharter(!charter)} checked={charter} />
                        <label htmlFor="charter">Je m'engage au respect de <a href="/charter" target="_blank" className="text-primary underline">la charte du label</a></label>
                    </div>
                    <div className="flex items-start gap-3">
                        <input id="conditions" type="checkbox" className="mt-0.5" onChange={(e) => setConditions(!conditions)} checked={conditions} />
                        <div className="flex flex-col gap-2">
                            <label htmlFor="conditions">Déclaration d'engagement au respect de <a href="/charter" target="_blank" className="text-primary underline">la charte du label</a></label>
                            <p className="text-trivial text-sm">
                                Je déclare sur l'honneur l'exactitude des informations fournies dans ce formulaire. Je suis conscient que le non-respect des engagements pris dans ce formulaire peut entraîner la suspension ou la révocation de mon adhésion au label solaire PV.
                            </p>
                        </div>
                    </div>
                </div>
                <p className="mt-7">
                    En soumettant ce formulaire, vous vous inscrivez à la formation de label {label}. Un représentant du label vous contactera pour confirmer votre inscription et vous fournir les informations relatives au paiement et au déroulement de la formation.
                </p>
                <div className="flex flex-col justify-center items-center mt-10 gap-2">
                    {error && <p className="text-red-500">Une erreur est survenue.</p>}
                    <button className="btn btn-primary px-28 py-2.5 flex items-center gap-3 disabled:opacity-70 disabled:cursor-not-allowed" disabled={!charter || !conditions}>
                        Valider
                        <Spinner loading={submitting}/>
                    </button>
                </div>
            </form>
        </>
    )
}