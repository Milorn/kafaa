import { useEffect, useState } from "react";

export default function RegisterExpert({ label, expert, setExpert, errors, clearErrors }) {
    const [wilayas, setWilayas] = useState([]);
    useEffect(() => {
        axios.get('/data/wilayas')
            .then(({ data }) => setWilayas(data));
    }, []);

    const change = (e) => {
        setExpert({
            ...expert,
            [e.target.name]: e.target.value
        });
        clearErrors('expert', e.target.name);
    };

    const handleFile = (e) => {
        if (e.target.files && e.target.files[0]) {
            setExpert({
                ...expert,
                resumee: e.target.files[0]
            });
        }
        clearErrors('expert', 'resumee');
    }

    return (
        <>
            <h3 className="text-center text-2xl text-[#6A6A6A] mb-14">Inscription pour les installateurs {label.toUpperCase()}</h3>
            <div className="grid grid-cols-2 gap-x-14 gap-y-7">
                <div className="flex flex-col gap-7">
                    <div className="fieldset">
                        <label htmlFor="lname">Nom</label>
                        <input id="lname" name="lname" type="text" className={errors.lname && "border border-red-500"} placeholder="Nom" value={expert.lname} onChange={change} />
                        <p className="text-sm text-red-500">{errors.lname}</p>
                    </div>
                    <div className="fieldset">
                        <label htmlFor="fname">Prénom</label>
                        <input id="fname" name="fname" type="text" className={errors.fname && "border border-red-500"} placeholder="Prénom" value={expert.fname} onChange={change} />
                        <p className="text-sm text-red-500">{errors.fname}</p>
                    </div>

                    <div className="fieldset">
                        <label htmlFor="wilaya">Wilaya</label>
                        <div className="relative">
                            <select id="wilaya" name="wilaya" className={`w-full field ${errors.wilaya && "border border-red-500"}`} value={expert.wilaya} onChange={change}>
                                <option value="" disabled>Please select</option>
                                {
                                    wilayas.map((wilaya) => (
                                        <option key={wilaya.id} value={wilaya.id}>{wilaya.code} - {wilaya.name}</option>
                                    ))
                                }
                            </select>
                            <svg className="pointer-events-none absolute top-0 right-0 mt-3 mr-3" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                        <p className="text-sm text-red-500">{errors.wilaya}</p>
                    </div>

                    <div className="fieldset">
                        <label htmlFor="address">Adresse</label>
                        <input id="address" name="address" type="text" className={errors.address && "border border-red-500"} placeholder="Adresse" value={expert.address} onChange={change} />
                        <p className="text-sm text-red-500">{errors.address}</p>
                    </div>

                    <div className="fieldset">
                        <label htmlFor="phone">Téléphone</label>
                        <input id="phone" name="phone" type="tel" className={errors.phone && "border border-red-500"} placeholder="0555555555" value={expert.phone} onChange={change} />
                        <p className="text-sm text-red-500">{errors.phone}</p>
                    </div>

                    <div className="fieldset">
                        <label htmlFor="email">Email</label>
                        <input id="email" name="email" type="email" className={errors.email && "border border-red-500"} placeholder="test@example.com" value={expert.email} onChange={change} />
                        <p className="text-sm text-red-500">{errors.email}</p>
                    </div>

                    <div className="fieldset">
                        <label htmlFor="password">Mot de passe</label>
                        <input id="password" name="password" type="password" className={errors.password && "border border-red-500"} placeholder="********" value={expert.password} onChange={change} />
                        <p className="text-sm text-red-500">{errors.password}</p>
                    </div>

                </div>
                <div className="flex flex-col gap-7">

                    <div className="fieldset">
                        <label htmlFor="diploma">Diplôme</label>
                        <input id="diploma" name="diploma" type="text" className={errors.diploma && "border border-red-500"} placeholder="Diplôme" value={expert.diploma} onChange={change} />
                        <p className="text-sm text-red-500">{errors.diploma}</p>
                    </div>

                    <div className="fieldset">
                        <label htmlFor="years_of_experience">Nombre d'années</label>
                        <input id="years_of_experience" name="years_of_experience" className={errors.years_of_experience && "border border-red-500"} type="number" placeholder="Nombre d'années" value={expert.years_of_experience} onChange={change} />
                        <p className="text-sm text-red-500">{errors.years_of_experience}</p>
                    </div>

                    <div className="fieldset">
                        <label htmlFor="number_of_projects">{label == 'pv' ? 'Nombre de projets solaires photovoltaïques installés' : "Projet d'EP conventionnel"}</label>
                        <input id="number_of_projects" name="number_of_projects" className={errors.number_of_projects && "border border-red-500"} type="number" placeholder="Nombre de projets" value={expert.number_of_projects} onChange={change} />
                        <p className="text-sm text-red-500">{errors.number_of_projects}</p>
                    </div>

                    <div className="fieldset">
                        <label htmlFor="number_of_metric">{label == 'pv' ? "Nombre de kWc installées" : "Projet d'EP solaire "}</label>
                        <input id="number_of_metric" name="number_of_metric" type="number" className={errors.number_of_metric && "border border-red-500"} placeholder="Nombre" value={expert.number_of_metric} onChange={change} />
                        <p className="text-sm text-red-500">{errors.number_of_metric}</p>
                    </div>

                    <div className="fieldset">
                        <label htmlFor="professional_status">Statut professionnel</label>
                        <div className="relative">
                            <select id="professional_status" name="professional_status" className={`w-full field  ${errors.professional_status && "border border-red-500"}`} value={expert.professional_status} onChange={change}>
                                <option value="" disabled>Please select</option>
                                <option value="employed">Employé</option>
                                <option value="unemployed">Chômeur</option>
                            </select>
                            <svg className="pointer-events-none absolute top-0 right-0 mt-3 mr-3" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                        <p className="text-sm text-red-500">{errors.professional_status}</p>
                    </div>



                    <div className="fieldset">
                        <label>Joindre le CV en format PDF</label>
                        <label htmlFor="resumee" className={`btn btn-primary text-center py-2.5 hover:cursor-pointer ${errors.resumee && "bg-red-500"}`}>
                            Choisir un fichier
                            {expert.resumee && <span className="text-xs font-base overflow-hidden">: 1 fichier choisi</span>}
                        </label>
                        <input id="resumee" name="resumee" type="file" className="hidden" onChange={handleFile} />
                        <p className="text-sm text-red-500">{errors.resumee}</p>
                    </div>

                </div>
            </div>
        </>
    )
}