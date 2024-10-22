
export default function RegisterEmployee({ index, employee, changeEmployee, errors }) {

    const change = (e) => {
        changeEmployee(index, e.target.name, e.target.value);
    };

    return (
        <>
            <div className="grid grid-cols-2 gap-x-14 gap-y-7">
                <div className="flex flex-col gap-7">
                    <div className="fieldset">
                        <label htmlFor={`employee-lname-${index}`}>Nom</label>
                        <input id={`employee-lname-${index}`} name="lname" type="text" placeholder="Nom" value={employee.lname} onChange={change} required/>
                    </div>
                    <div className="fieldset">
                        <label htmlFor={`employee-fname-${index}`}>Prénom</label>
                        <input id={`employee-fname-${index}`} name="fname" type="text" placeholder="Prénom" value={employee.fname} onChange={change} required/>
                    </div>

                    <div className="fieldset">
                        <label htmlFor={`employee-address-${index}`}>Adresse</label>
                        <input id={`employee-address-${index}`} name="address" type="text" placeholder="Adresse" value={employee.address} onChange={change}/>
                    </div>


                </div>
                <div className="flex flex-col gap-7">
                    <div className="fieldset">
                        <label htmlFor={`employee-phone-${index}`}>Téléphone</label>
                        <input id={`employee-phone-${index}`} name="phone" type="tel" placeholder="0555555555" value={employee.phone} onChange={change}/>
                    </div>

                    <div className="fieldset">
                        <label htmlFor={`employee-email-${index}`}>Email</label>
                        <input id={`employee-email-${index}`} name="email" type="email" placeholder="test@example.com" value={employee.email} onChange={change}/>
                    </div>

                    <div className="fieldset">
                        <label htmlFor={`employee-label-${index}`}>Label</label>
                        <div className="relative">
                            <select id={`employee-label-${index}`} name="label" className="w-full field" value={employee.label} onChange={change} required>
                                <option value="" disabled>Veuillez choisir</option>
                                <option value="pv">PV</option>
                                <option value="epe">EPE</option>
                            </select>
                            <svg className="pointer-events-none absolute top-0 right-0 mt-3 mr-3" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </div>


                </div>
            </div>
        </>
    )
}