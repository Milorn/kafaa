import { useEffect, useState } from "react"


export default function RegisterProvider({ provider, setProvider, errors, clearErrors }) {
    const [activityAreas, setActivityAreas] = useState([]);
    useEffect(() => {
        axios.get('/data/activity-areas')
            .then(({ data }) => setActivityAreas(data));
    }, []);

    const change = (e) => {
        setProvider({
            ...provider,
            [e.target.name]: e.target.value
        });
        clearErrors('provider', e.target.name);
    };

    const handleFile = (e) => {
        if (e.target.files && e.target.files.length > 0) {
            setProvider({
                ...provider,
                registry: e.target.files[0]
            });
        }
        clearErrors('provider', 'registry');
    }

    return (
        <>
            <h3 className="text-center text-2xl text-[#6A6A6A] mb-14">Inscription pour les fournisseurs</h3>
            <div className="grid grid-cols-2 gap-x-14 gap-y-7">
                <div className="flex flex-col gap-7">
                    <div className="fieldset">
                        <label htmlFor="provider_name">Nom du fournisseur</label>
                        <input type="text" id="provider_name" name="provider_name" className={errors.provider_name && "border border-red-500"} placeholder="Nom du fournisseur" value={provider.provider_name} onChange={change} />
                        <p className="text-sm text-red-500">{errors.provider_name}</p>
                    </div>

                    <div className="fieldset">
                        <label htmlFor="address">Adresse</label>
                        <input type="text" id="address" name="address" className={errors.address && "border border-red-500"} placeholder="Adresse" value={provider.address} onChange={change} />
                        <p className="text-sm text-red-500">{errors.address}</p>
                    </div>

                    <div className="fieldset">
                        <label htmlFor="phone">Téléphone</label>
                        <input type="tel" id="phone" name="phone" className={errors.phone && "border border-red-500"} placeholder="0555555555" value={provider.phone} onChange={change} />
                        <p className="text-sm text-red-500">{errors.phone}</p>
                    </div>

                    <div className="fieldset">
                        <label htmlFor="email">Email</label>
                        <input type="email" id="email" name="email" className={errors.email && "border border-red-500"} placeholder="test@example.com" value={provider.email} onChange={change} />
                        <p className="text-sm text-red-500">{errors.email}</p>
                    </div>

                    <div className="fieldset">
                        <label htmlFor="website">Site web</label>
                        <input type="url" id="website" name="website" className={errors.website && "border border-red-500"} placeholder="https://website.com" value={provider.website} onChange={change} />
                        <p className="text-sm text-red-500">{errors.website}</p>
                    </div>
                </div>
                <div className="flex flex-col gap-7">
                    <div className="fieldset">
                        <label htmlFor="responsible_name">Nom du résponsable</label>
                        <input type="text" id="responsible_name" name="responsible_name" className={errors.responsible_name && "border border-red-500"} placeholder="Nom du résponsable" value={provider.responsible_name} onChange={change} />
                        <p className="text-sm text-red-500">{errors.responsible_lname}</p>
                    </div>

                    <div className="fieldset">
                        <label htmlFor="responsible_job">Fonction du résponsable</label>
                        <input type="text" id="responsible_job" name="responsible_job" className={errors.responsible_job && "border border-red-500"} placeholder="Fonction du résponsable" value={provider.responsible_job} onChange={change} />
                        <p className="text-sm text-red-500">{errors.responsible_job}</p>
                    </div>

                    <div className="fieldset">
                        <label htmlFor="activity-area">Domaine d'activité</label>
                        <div className="relative">
                            <select id="activity-area" name="activity_area" className={`w-full field ${errors.activity_area && "border border-red-500"}`} value={provider.activityArea} onChange={change}>
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
                        <label htmlFor="resumee" className={`btn btn-primary text-center py-2.5 hover:cursor-pointer ${errors.registry && "bg-red-500"}`}>
                            Choisir un fichier
                            {provider.registry && <span className="text-xs font-base overflow-hidden">: 1 fichier choisi</span>}
                        </label>
                        <input id="resumee" type="file" name="registry" className="hidden" onChange={handleFile} />
                        <p className="text-sm text-red-500">{errors.registry}</p>
                    </div>
                </div>

            </div>
        </>
    )
}