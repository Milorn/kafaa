import { useState } from "react"

export default function RegisterForm() {
    return (
        <>
            <div className="flex flex-col gap-7 px-6 py-12 bg-[#F8F8F8] rounded-lg shadow-bottom">
                <div className="flex flex-col gap-1">
                    <label className="text-semibold text-[#333333]" htmlFor="type">Vous représentez :</label>
                    <div className="relative">
                        <select id="type" className="border-[#BBBBBB] rounded-lg px-3 w-full focus:outline-none shadow-bottom text-[#333]">
                            <option value="" disabled selected>Please select</option>:
                            <option value="expert">Installateur</option>
                            <option value="company">Entreprise</option>
                            <option value="provider">Fournisseur</option>
                        </select>
                        <svg class="pointer-events-none absolute top-0 right-0 mt-3 mr-3" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </div>
                </div>

                <div className="flex flex-col gap-1">
                    <label className="text-semibold text-[#333333]" htmlFor="type">Choisissez un label</label>
                    <div className="relative">
                        <select id="type" className="border-[#BBBBBB] rounded-lg px-3 w-full focus:outline-none shadow-bottom text-[#333]">
                            <option value="" disabled selected>Please select</option>:
                            <option value="epe">EPE</option>
                            <option value="pv">PV</option>
                        </select>
                        <svg class="pointer-events-none absolute top-0 right-0 mt-3 mr-3" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </div>
                </div>
            </div>
        </>
    )
}