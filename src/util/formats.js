export function currencyFormat(value){
	if(!value && typeof value !== 'number') return null;
	return new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(value).replace(/\D00$/, '');
}


export function numberFormat(value){
    if(!value && typeof value !== 'number') return null;
    return new Intl.NumberFormat('es-CO').format(value).replace(/\D00$/, '');
}
