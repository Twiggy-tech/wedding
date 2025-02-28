export type Guest = {
    id: number,
    token: string,
    firstName: string,
    surname: string,
    willAttend: boolean,
    willAttendMainCeremony: boolean,
    gender: GuestGenderEnum
    preferredDrinks: Drink[]
}

export enum GuestGenderEnum {
    MAN = 'MAN',
    WOMAN = 'WOMAN',
    MULTIPLE = 'MULTIPLE',
}

export type EditGuestInput = {
    id: number,
    willAttend: boolean,
}

export type Drink = {
    id: number,
    name: string,
}

export type SelectDrinksInput = {
    guestId: number,
    drinkIds: number[],
}
