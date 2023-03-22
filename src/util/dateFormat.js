import dayjs from 'dayjs';
import 'dayjs/locale/es';

export function dateFormat( date, format) {
	return dayjs(date ?? Date()).locale('es').format(format);
}
