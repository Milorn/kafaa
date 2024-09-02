import { useEffect, useState } from "react"
import RegisterEmployee from "./RegisterEmployee";
import { TrashIcon } from "@heroicons/react/16/solid";

export default function RegisterCompany({ company, setCompany, errors, clearErrors }) {
    const [activityAreas, setActivityAreas] = useState([]);
    useEffect(() => {
        axios.get('/data/activity-areas')
            .then(({ data }) => setActivityAreas(data));
    }, []);

    const change = (e) => {
        setCompany({
            ...company,
            [e.target.name]: e.target.value
        });
        clearErrors('company', e.target.name);
    };

    const handleFile = (e) => {
        if (e.target.files && e.target.files.length > 0) {
            setCompany({
                ...company,
                registry: e.target.files[0]
            });
        }
        clearErrors('company', 'registry');
    }

    const addEmployee = () => {
        const obj = { ...company };
        obj.employees.push({
            fname: "", lname: "", address: "", phone: "", email: "", label: "",
        });
        setCompany(obj);
    };

    const removeEmployee = (index) => {
        const obj = { ...company };
        obj.employees.splice(index, 1);
        setCompany(obj);
    }

    const changeEmployee = (index, name, value) => {
        const obj = { ...company };
        obj.employees[index][name] = value;
        setCompany(obj);
    }

    return (
        <>
            <h3 className="text-center text-2xl text-[#6A6A6A] mb-14">Inscription pour les entreprises</h3>
            <div className="grid grid-cols-2 gap-x-14 gap-y-7">
                <div className="flex flex-col gap-7">
                    <div className="fieldset">
                        <label htmlFor="company_name">Nom de l'entreprise</label>
                        <input type="text" id="company_name" name="company_name" className={errors.company_name && "border border-red-500"} placeholder="Nom de l'entreprise" value={company.company_name} onChange={change} />
                        <p className="text-sm text-red-500">{errors.company_name}</p>
                    </div>

                    <div className="fieldset">
                        <label htmlFor="address">Adresse</label>
                        <input type="text" id="address" name="address" className={errors.address && "border border-red-500"} placeholder="Adresse"  value={company.address} onChange={change} />
                        <p className="text-sm text-red-500">{errors.address}</p>
                    </div>

                    <div className="fieldset">
                        <label htmlFor="phone">Téléphone</label>
                        <input type="tel" id="phone" name="phone" className={errors.phone && "border border-red-500"} placeholder="0555555555" value={company.phone} onChange={change} />
                        <p className="text-sm text-red-500">{errors.phone}</p>
                    </div>

                    <div className="fieldset">
                        <label htmlFor="email">Email</label>
                        <input type="email" id="email" name="email" className={errors.email && "border border-red-500"} placeholder="test@example.com" value={company.email} onChange={change} />
                        <p className="text-sm text-red-500">{errors.email}</p>
                    </div>

                    <div className="fieldset">
                        <label htmlFor="website">Site web</label>
                        <input type="url" id="website" name="website" className={errors.website && "border border-red-500"} placeholder="https://website.com" value={company.website} onChange={change} />
                        <p className="text-sm text-red-500">{errors.website}</p>
                    </div>
                </div>
                <div className="flex flex-col gap-7">
                    <div className="fieldset">
                        <label htmlFor="responsible_lname">Nom du résponsable</label>
                        <input type="text" id="responsible_name" className={errors.responsible_name && "border border-red-500"} name="responsible_name" placeholder="Nom du résponsable" value={company.responsible_name} onChange={change} />
                        <p className="text-sm text-red-500">{errors.responsible_name}</p>
                    </div>

                    <div className="fieldset">
                        <label htmlFor="responsible_job">Fonction du résponsable</label>
                        <input type="text" id="responsible_job" className={errors.responsible_job && "border border-red-500"} name="responsible_job" placeholder="Fonction du résponsable" value={company.responsible_job} onChange={change} />
                        <p className="text-sm text-red-500">{errors.responsible_job}</p>
                    </div>

                    <div className="fieldset">
                        <label htmlFor="activity-area">Domaine d'activité</label>
                        <div className="relative">
                            <select id="activity-area" name="activity_area" className={`w-full field ${errors.activity_area && "border border-red-500"}`} value={company.activityArea} onChange={change}>
                                <option value="" disabled>Please select</option>
                                {
                                    activityAreas.map((area) => (
                                        <option key={area.id} value={area.id}>{area.name}</option>
                                    ))
                                }
                            </select>
                            <svg className="pointer-events-none absolute top-0 right-0 mt-3 mr-3" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                        <p className="text-sm text-red-500">{errors.activity_area}</p>
                    </div>

                    <div className="fieldset">
                        <label>Joindre le registre de commerce en format PDF</label>
                        <p className="text-xs text-trivial">
                            Veuillez fournir une copie de votre registre du commerce attestant de l'existence légale de votre entreprise
                        </p>
                        <label htmlFor="registry" className={`btn btn-primary text-center py-2.5 hover:cursor-pointer ${errors.registry && "bg-red-500"}`}>
                            Choisir un fichier
                            {company.registry && <span className="text-xs font-base overflow-hidden">: 1 fichier choisi</span>}
                            </label>
                        <input id="registry" type="file" name="registry" className="hidden" onChange={handleFile} />
                        <p className="text-sm text-red-500">{errors.registry}</p>
                    </div>
                </div>

            </div>
            <h3 className="mt-16 mb-8 text-black text-lg">Les employés souhaitant labeliser</h3>
            <div className="flex flex-col gap-4 mb-8">
                {
                    company.employees.map((employee, index) => (
                        <div key={index}>
                            <div className="flex justify-end">
                                <button type="button" onClick={() => removeEmployee(index)}>
                                    <TrashIcon className="size-5 fill-red-500" />
                                </button>
                            </div>
                            <RegisterEmployee index={index} employee={employee} changeEmployee={changeEmployee} errors={errors.employees}/>
                            <hr className="mt-4" />
                        </div>
                    ))
                }
            </div>
            <div className="flex justify-center">
                <button type="button" onClick={addEmployee} className="btn btn-primary text-center py-2 hover:cursor-pointer text-sm font-semibold">Ajouter un employé</button>

            </div>
        </>
    )
}