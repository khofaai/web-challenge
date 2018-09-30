<template>
	<el-col :span="6">
	    <el-card :body-style="{ padding: '0px' }">
	      	<img :src="getImage()" class="image">
	      	<div style="padding: 5px;">
		        <div class="bottom clearfix">
			      	<el-col :span="9">
				        <span>{{ shop.shop_name }}</span>
			      	</el-col>
			      	<el-col :span="15">
			      		<template v-if="type == 'list'">
				          	<el-button @click="Dislike" type="danger">Dislike</el-button>
				          	<el-button @click="Like" type="success">Like</el-button>
			      		</template>
			      		<template v-else>
				          	<el-button style="float: right" @click="Remove" type="danger">Remove</el-button>
			      		</template>
			      	</el-col>
		        </div>
	      	</div>
	    </el-card>
	</el-col>
</template>
<script>
	
	import { Card, Col, Button } from 'element-ui';

	export default {
		props:{
			shop:{
				default:() => {
					return {
						name: 'Shop name'
					}
				}
			},
			type:{
				default:'list'
			}
		},
		components: {
			'el-card': Card, 
			'el-col': Col, 
			'el-button': Button			
		},
		methods:{
			Remove() {
				axios.post('remove-shop',{
					id:this.shop.shop_id
				}).then( resp => {
					if (resp.data.status == 200) {
						this.$emit('reload',resp.data.message);
					}
				});
			},
			Dislike () {
				axios.post('dislike-shop',{
					id:this.shop.shop_id
				}).then( resp => {
					if (resp.data.status == 200) {
						this.$emit('reload',resp.data.message);
					}
				});
			},
			Like () {
				axios.post('like-shop',{
					id:this.shop.shop_id
				}).then( resp => {
					if (resp.data.status == 200) {
						this.$emit('reload',resp.data.message);
					}
				});
			},
			getImage() {
				return 'https://picsum.photos/200/200?image='+(this.shop.shop_id+50)
			}
		}
	}
</script>
<style>
  .time {
    font-size: 13px;
    color: #999;
  }
  
  .bottom {
    margin-top: 13px;
    line-height: 12px;
  }

  .button {
    padding: 0;
    float: right;
  }

  .image {
    width: 100%;
    display: block;
  }

  .clearfix:before,
  .clearfix:after {
      display: table;
      content: "";
  }
  
  .clearfix:after {
      clear: both
  }
  .el-card {
  	margin-bottom: 10px
  }
</style>