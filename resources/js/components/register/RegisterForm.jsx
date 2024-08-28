import { Field, Form, Formik } from "formik";
import { useState } from "react"
import RegisterExpert from "./RegisterExpert";
import RegisterCompany from "./RegisterCompany";
import RegisterProvider from "./RegisterProvider";

export default function RegisterForm() {
    const [type, setType] = useState('company');
    const [label, setLabel] = useState('');
    const [submitting, setSubmitting] = useState(false);

    const submit = (e) => {
        e.preventDefault();
        setSubmitting(true);
        alert(type);
    };

    return (
        <>
            <form onSubmit={submit}>
                <div className="flex flex-col gap-7 px-6 py-12 bg-[#F8F8F8] rounded-lg shadow-bottom">
                    <div className="fieldset">
                        <label htmlFor="type">Vous représentez :</label>
                        <div className="relative">
                            <select id="type" className="w-full shadow-bottom" onChange={(e) => setType(e.target.value)} defaultValue={type}>
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
                                <select id="label" className="w-full shadow-bottom" onChange={(e) => setLabel(e.target.value)} defaultValue={label}>
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
                            type == 'company' ? <RegisterCompany />
                                : type == 'provider' ? <RegisterProvider />
                                    : type == 'expert' && label && <RegisterExpert label={label} />
                        }
                    </div>
                }

                <hr className="my-7" />

                <div className="flex flex-col gap-y-5">
                    <div className="flex items-center gap-3">
                        <input id="charter" type="checkbox" />
                        <label htmlFor="charter">Je m'engage au respect de la charte du label</label>
                    </div>
                    <div className="flex items-start gap-3">
                        <input id="conditions" type="checkbox" className="mt-0.5" />
                        <div className="flex flex-col gap-2">
                            <label htmlFor="conditions">Déclaration d'engagement au respect de la charte du label</label>
                            <p className="text-trivial text-sm">
                                Je déclare sur l'honneur l'exactitude des informations fournies dans ce formulaire. Je suis conscient que le non-respect des engagements pris dans ce formulaire peut entraîner la suspension ou la révocation de mon adhésion au label solaire PV.
                            </p>
                        </div>
                    </div>
                </div>
                <p className="mt-7">
                    En soumettant ce formulaire, vous vous inscrivez à la formation de label {label}. Un représentant du label vous contactera pour confirmer votre inscription et vous fournir les informations relatives au paiement et au déroulement de la formation.
                </p>
               <div className="flex justify-center">
               <button className="mt-11 btn btn-primary px-28 py-2.5">
                    Valider
                </button>
               </div>
            </form>
        </>
    )
}