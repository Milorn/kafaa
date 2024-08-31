
export default function RegisterExpert({ label, expert, setExpert }) {

    const change = (e) => {
        setExpert({
            ...expert,
            [e.target.name]: e.target.value
        });
    };

    const handleFile = (e) => {
        if (e.target.files && e.target.files.length > 0) {
            setExpert({
                ...expert,
                resumee: e.target.files[0]
            });
        }
    }

    return (
        <>
            <h3 className="text-center text-2xl text-[#6A6A6A] mb-14">Inscription pour les installateurs {label.toUpperCase()}</h3>
            <div className="grid grid-cols-2 gap-x-14 gap-y-7">
                <div className="flex flex-col gap-7">
                    <div className="fieldset">
                        <label htmlFor="lname">Nom</label>
                        <input id="lname" name="lname" type="text" placeholder="Nom" value={expert.lname} onChange={change} />
                    </div>
                    <div className="fieldset">
                        <label htmlFor="fname">Prénom</label>
                        <input id="fname" name="fname" type="text" placeholder="Prénom" value={expert.fname} onChange={change} />
                    </div>

                    <div className="fieldset">
                        <label htmlFor="address">Adresse</label>
                        <input id="address" name="address" type="text" placeholder="Adresse" value={expert.address} onChange={change} />
                    </div>

                    <div className="fieldset">
                        <label htmlFor="phone">Téléphone</label>
                        <input id="phone" name="phone" type="tel" placeholder="0555555555" value={expert.phone} onChange={change} />
                    </div>

                    <div className="fieldset">
                        <label htmlFor="email">Email</label>
                        <input id="email" name="email" type="email" placeholder="test@example.com" value={expert.email} onChange={change} />
                    </div>

                    <div className="fieldset">
                        <label htmlFor="diploma">Diplôme</label>
                        <input id="diploma" name="diploma" type="text" placeholder="Diplôme" value={expert.diploma} onChange={change} />
                    </div>
                </div>
                <div className="flex flex-col gap-7">
                    <h6 className="text-sm font-semibold">Expérience dans le domaine {label == 'pv' ? "d'installation solaire" : "de l'éclairage public"}</h6>

                    <div className="fieldset">
                        <label htmlFor="number_of_years">Nombre d'années</label>
                        <input id="number_of_years" name="number_of_years" type="number" placeholder="Nombre d'années" value={expert.number_of_years} onChange={change} />
                    </div>

                    <div className="fieldset">
                        <label htmlFor="number_of_projects">{label == 'pv' ? 'Nombre de projets solaires photovoltaïques installés' : "Projet d'EP conventionnel"}</label>
                        <input id="number_of_projects" name="number_of_projects" type="number" placeholder="Nombre de projets" value={expert.number_of_projects} onChange={change} />
                    </div>

                    <div className="fieldset">
                        <label htmlFor="number_of_metrics">{label == 'pv' ? "Nombre de kWc installées" : "Projet d'EP solaire "}</label>
                        <input id="number_of_metrics" name="number_of_metrics" type="number" placeholder="Nombre" value={expert.number_of_metrics} onChange={change} />
                    </div>

                    <div className="fieldset">
                        <label htmlFor="professional_status">Statut professionnel</label>
                        <div className="relative">
                            <select id="professional_status" name="professional_status" className="w-full field text-[#BBB]" value={expert.professional_status} onChange={change}>
                                <option value="" disabled>Please select</option>
                                <option value="employed">Employé</option>
                                <option value="unemployed">Chômeur</option>
                            </select>
                            <svg className="pointer-events-none absolute top-0 right-0 mt-3 mr-3" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </div>

                    <div className="fieldset">
                        <label>Joindre le CV en format PDF</label>
                    </div>

                    <div className="fieldset">
                        <label htmlFor="resumee" className="btn btn-primary text-center py-2.5 hover:cursor-pointer">
                            Choisir un fichier 
                            {expert.resumee && <span className="text-xs font-base overflow-hidden">: 1 fichier choisi</span>}
                            </label>
                        <input id="resumee" name="resumee" type="file" className="hidden" onChange={handleFile} />

                    </div>

                </div>
            </div>
        </>
    )
}