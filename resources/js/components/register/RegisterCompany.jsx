import { useEffect, useState } from "react"
import RegisterEmployee from "./RegisterEmployee";
import { TrashIcon } from "@heroicons/react/16/solid";

export default function RegisterCompany() {
    const [activityAreas, setActivityAreas] = useState([]);
    const [employees, setEmployees] = useState([]);
    useEffect(() => {
        axios.get('/data/activity-areas')
            .then(({ data }) => setActivityAreas(data));
    }, []);

    const removeEmployee = (index) => {
        const arr = [...employees];
        arr.splice(index, 1);
        setEmployees(arr);
    }
    
    return (
        <>
            <h3 className="text-center text-2xl text-[#6A6A6A] mb-14">Inscription pour les entreprises</h3>
            <div className="grid grid-cols-2 gap-x-14 gap-y-7">
                <div className="flex flex-col gap-7">
                    <div className="fieldset">
                        <label htmlFor="company_name">Nom de l'entreprise</label>
                        <input type="text" id="company_name" placeholder="Nom de l'entreprise" />
                    </div>

                    <div className="fieldset">
                        <label htmlFor="address">Adresse</label>
                        <input type="text" id="address" placeholder="Adresse" />
                    </div>

                    <div className="fieldset">
                        <label htmlFor="phone">Téléphone</label>
                        <input type="tel" id="phone" placeholder="0555555555" />
                    </div>

                    <div className="fieldset">
                        <label htmlFor="email">Email</label>
                        <input type="email" id="email" placeholder="test@example.com" />
                    </div>

                    <div className="fieldset">
                        <label htmlFor="website">Site web</label>
                        <input type="url" id="website" placeholder="https://website.com" />
                    </div>
                </div>
                <div className="flex flex-col gap-7">
                    <div className="fieldset">
                        <label htmlFor="responsible_lname">Nom du résponsable</label>
                        <input type="text" id="responsible_lname" placeholder="Nom du résponsable" />
                    </div>

                    <div className="fieldset">
                        <label htmlFor="responsible_job">Fonction du résponsable</label>
                        <input type="text" id="responsible_job" placeholder="Fonction du résponsable" />
                    </div>

                    <div className="fieldset">
                        <label htmlFor="activity-area">Domaine d'activité</label>
                        <div className="relative">
                            <select id="activity-area" className="w-full field" defaultValue="">
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
                    </div>

                    <div className="fieldset">
                        <label>Joindre le registre de commerce en format PDF</label>
                        <p className="text-xs text-trivial">
                            Veuillez fournir une copie de votre registre du commerce attestant de l'existence légale de votre entreprise
                        </p>
                        <label htmlFor="resumee" className="btn btn-primary text-center py-2.5 hover:cursor-pointer">Choisir un fichier</label>
                        <input id="resumee" type="file" className="hidden" />

                    </div>
                </div>

            </div>
            <h3 className="mt-16 mb-8 text-black text-lg">Les employés souhaitant labeliser</h3>
            <div className="flex flex-col gap-4 mb-8">
                {
                    employees.map((employee, index) => (
                        <div key={index}>
                            <div className="flex justify-end">
                                <button type="button" onClick={() => removeEmployee(index)}>
                                    <TrashIcon className="size-5 fill-red-500"/>
                                </button>
                            </div>
                            <RegisterEmployee index={index} />
                            <hr className="mt-4"/>
                        </div>
                    ))
                }
            </div>
            <div className="flex justify-center">
                <button type="button" onClick={() => setEmployees([...employees, {}])} className="btn btn-primary text-center py-2 hover:cursor-pointer text-sm font-semibold">Ajouter un employé</button>

            </div>
        </>
    )
}