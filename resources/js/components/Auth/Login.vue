<template>
	<el-col :span="8" :offset="8">
		<h1 style="text-align: center">Login</h1>
		<small style="display: block;text-align: center;"><router-link to="/register"><el-button type="text">register new account</el-button></router-link></small>
		<hr>
		<el-form size="medium" label-position="left" :model="ruleForm2" status-icon ref="ruleForm2" label-width="120px" class="demo-ruleForm">
			<el-form-item
			    prop="username"
			    label="Username"
			    :rules="[
			      { required: true, message: 'Please input username', trigger: 'blur' }
			    ]"
			  >
			    <el-input v-model="ruleForm2.username"></el-input>
			</el-form-item>
			<el-form-item 
				label="Password" 
				prop="password"
				:rules="[
					{required: true, message: 'Please input the password', trigger: 'blur'}
				]">
				<el-input type="password" v-model="ruleForm2.password" autocomplete="off"></el-input>
			</el-form-item>
			<el-form-item>
				<small style="display: block;float: left;"><router-link to="/reset-password"><el-button type="text" >forget password ?</el-button></router-link></small>
				<el-button style="float: right" type="info" @click="submitForm('ruleForm2')">Sign in</el-button>
			</el-form-item>
		</el-form>
	</el-col>	
</template>
<script>
	import { Col, Form, FormItem, Input, Button, Notification } from 'element-ui';
	import { eventBus } from '../../app';

	export default {
		components:{
			'el-col': Col,
			'el-form': Form,
			'el-form-item': FormItem,
			'el-input': Input,
			'el-button': Button,
		},
    	data() {
			var validateUsername = (rule, value, callback) => {
				alert('value ' + value)
				if (value === '') {
					callback(new Error('Please input the username'));
				} else {
					callback();
				}
			};
			var validatePass2 = (rule, value, callback) => {
				if (value === '') {
					callback(new Error('Please input the password'));
				} else {
					callback();
				}
			};
			return {
				ruleForm2: {
					username: 'anaselalamikh@gmail.com',
					password: '123456'
				}
			};
		},
		methods: {
			submitForm(formName) {
				this.$refs[formName].validate((valid) => {
					if (valid) {
						axios.post('login',{
							email:this.ruleForm2.username,
							password:this.ruleForm2.password,
						}).then( resp => {
							localStorage.setItem('logged',true);
							setTimeout(() => {
								Notification.success({
									title:"Success",
									message:"logged successfully",
									type:"success"
								});
								eventBus.$emit('logged');
								this.$router.push('/');
							}, 500);
						});
					} else {

						return false;
					}
				});
			},
			resetForm(formName) {
				this.$refs[formName].resetFields();
			}
		}
  	}
</script>