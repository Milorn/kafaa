
export default function RegisterExpert({ label }) {
    return (
        <>
            <h3 className="text-center text-2xl text-[#6A6A6A] mb-14">Inscription pour les installateurs {label.toUpperCase()}</h3>
            <div className="grid grid-cols-2 gap-x-14 gap-y-7">
                <div className="flex flex-col gap-7">
                    <div className="fieldset">
                        <label htmlFor="lname">Nom</label>
                        <input id="lname" type="text" placeholder="Nom" />
                    </div>
                    <div className="fieldset">
                        <label htmlFor="fname">Prénom</label>
                        <input id="fname" type="text" placeholder="Prénom" />
                    </div>

                    <div className="fieldset">
                        <label htmlFor="address">Adresse</label>
                        <input id="address" type="text" placeholder="Adresse" />
                    </div>

                    <div className="fieldset">
                        <label htmlFor="phone">Téléphone</label>
                        <input id="phone" type="tel" placeholder="0555555555" />
                    </div>

                    <div className="fieldset">
                        <label htmlFor="email">Email</label>
                        <input id="email" type="email" placeholder="test@example.com" />
                    </div>

                    <div className="fieldset">
                        <label htmlFor="diploma">Diplôme</label>
                        <input id="diploma" type="text" placeholder="Diplôme" />
                    </div>
                </div>
                <div className="flex flex-col gap-7">
                    <h6 className="text-sm font-semibold">Expérience dans le domaine {label == 'pv' ? "d'installation solaire" : "de l'éclairage public"}</h6>

                    <div className="fieldset">
                        <label htmlFor="number_of_years">Nombre d'années</label>
                        <input id="number_of_years" type="number" placeholder="Nombre d'années" />
                    </div>

                    <div className="fieldset">
                        <label htmlFor="number_of_projects">{label == 'pv' ? 'Nombre de projets solaires photovoltaïques installés' : "Projet d'EP conventionnel"}</label>
                        <input id="number_of_projects" type="number" placeholder="Nombre de projets" />
                    </div>

                    <div className="fieldset">
                        <label htmlFor="number_of_metrics">{label == 'pv' ? "Nombre de kWc installées" : "Projet d'EP solaire "}</label>
                        <input id="number_of_projects" type="number" placeholder="Nombre" />
                    </div>

                    <div className="fieldset">
                        <label htmlFor="label">Statut professionnel</label>
                        <div className="relative">
                            <select id="label" className="w-full field text-[#BBB]" defaultValue="">
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
                        <label htmlFor="resumee" className="btn btn-primary text-center py-2.5 hover:cursor-pointer">Choisir un fichier</label>
                        <input id="resumee" type="file" className="hidden" />

                    </div>

                </div>
            </div>
        </>
    )
}