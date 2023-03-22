export function delay(callback, ms = 600) {
	if (window.retraso) clearInterval(window.retraso)
	window.retraso = setTimeout(callback, ms)
}
