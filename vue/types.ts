export type Guest = {
    id: number,
    token: string,
    firstName: string,
    surname: string,
    willAttend: boolean,
    willAttendMainCeremony: boolean,
    gender: GuestGenderEnum
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
