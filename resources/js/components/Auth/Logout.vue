<template></template>
<script>
	export default {
		methods:{
			logout() {
				axios.post('logout')
					 .then( resp => {
						localStorage.removeItem('logged');
						setTimeout(() => {
							this.$router.push('/login');
						}, 500);
					 });
			}
		},
		mounted() {

			this.logout();
		}
	}
</script>