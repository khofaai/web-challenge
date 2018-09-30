<template>
	<el-row :gutter="10">
		<ShopCard 
			v-for="shop in shops" 
			:key="shop.id" 
			:shop="shop" 
			@like="Like" 
			@dislike="Dislike"
			@reload="Reload" />
		<div v-if="shops.length == 0">
			no nearby shops appeared yet
		</div>
	</el-row>
</template>
<script>

	import { Row, Notification } from 'element-ui';
	import ShopCard from './ShopCard';

	export default {
		data() {
			return {
				shops: []
			}
		},
		components:{
			ShopCard,
			'el-row': Row
		},
		methods:{
			Reload(message) {
				Notification.success({
					title:"Success",
					message:message,
					type:"success"
				});
				this.loadShops();
			},
			Like(shop) {

			},
			Dislike(shop) {

			},
			loadShops() {
				axios.post('load-narby-shops')
					.then( resp => {
						this.shops = resp.data.shops;
					})
					.catch( err => {
						if (err.response.status == 403) {
							localStorage.removeItem('logged');
							setTimeout(() => {
								this.$router.push({path:'/login'});
							}, 10);
						}
					});
			}
		},
		mounted() {
			this.loadShops();
		}
	}
</script>