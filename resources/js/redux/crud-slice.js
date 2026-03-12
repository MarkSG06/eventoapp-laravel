import { createSlice } from "@reduxjs/toolkit";

export const crudSlice = createSlice({
    name: "crud",
    initialState: {
        formElementEndpoint: null,
        form: null,
        table: null,
    },
    reducers: {
        setForm: (state, action) => {
            state.form = action.payload.form;
            state.formElementEndpoint = action.payload.formElementEndpoint;
        },
        setTable: (state, action) => {
            state.table = action.payload;
        }
    },
});

export const { setForm, setTable } = crudSlice.actions;
export default crudSlice.reducer;