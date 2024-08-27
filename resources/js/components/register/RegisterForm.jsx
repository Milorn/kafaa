import { Field, Form, Formik } from "formik";
import { useState } from "react"
import RegisterExpert from "./RegisterExpert";
import RegisterCompany from "./RegisterCompany";
import RegisterProvider from "./RegisterProvider";

export default function RegisterForm() {
    const [type, setType] = useState('expert');
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
                </div>
                {
                    type && label && (
                        <div className="mt-10">
                            {
                                type == 'expert' ? <RegisterExpert label={label}/>
                                    : type == 'company' ? <RegisterCompany label={label}/>
                                        : <RegisterProvider label={label}/>
                            }
                        </div>
                    )
                }
            </form>
        </>
    )
}