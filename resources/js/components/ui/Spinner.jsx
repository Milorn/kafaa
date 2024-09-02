import { ClipLoader } from "react-spinners";

export default function Spinner({loading}) {
    return <ClipLoader color="white" size={25} loading={loading}/>;
}