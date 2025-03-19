<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3'
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Card, CardHeader, CardTitle, CardContent } from '@/components/ui/card'
import AppLayout from "@/layouts/AppLayout.vue";

const props = defineProps({
    user: Object,
    roles: Array,
    userRoles: Array
})


const form = useForm({
    name: props.user?.name || '',
    email: props.user?.email || '',
    roles: Array.isArray(props.userRoles) ? props.userRoles : []
});


const submit = () => {
    const updateUrl = route('users.update', props.user.id);
    form.put(updateUrl, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
            form.reset('name', 'email');
        },
        onError: (errors) => console.log('Erros:', errors)
    });
}
</script>

<template>
    <AppLayout>
        <div v-if="user && roles">
            <Head title="Editar Usuário" />
            <div class="p-6">
                <h1 class="text-2xl font-bold mb-6">Editar Usuário</h1>

                <form @submit.prevent="submit" class="space-y-4 max-w-md">
                    <div>
                        <Label for="name">Nome</Label>
                        <Input id="name" v-model="form.name" type="text" required />
                        <p v-if="form.errors.name" class="text-red-500 text-sm">{{ form.errors.name }}</p>
                    </div>

                    <div>
                        <Label for="email">Email</Label>
                        <Input id="email" v-model="form.email" type="email" required />
                        <p v-if="form.errors.email" class="text-red-500 text-sm">{{ form.errors.email }}</p>
                    </div>

                    <div>
                        <Label>Perfis</Label>
                        <Card>
                            <CardHeader>
                                <CardTitle>Selecione os Perfis</CardTitle>
                            </CardHeader>
                            <CardContent>
                                <div class="space-y-2">
                                    <div v-for="role in roles" :key="role.id" class="flex items-center space-x-2">
                                        <input
                                            type="checkbox"
                                            :id="`role-${role.id}`"
                                            v-model="form.roles"
                                            :value="role.id"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                                        />
                                        <label :for="`role-${role.id}`" class="text-sm">
                                            {{ role.name }}
                                        </label>
                                    </div>
                                </div>
                            </CardContent>
                        </Card>
                        <p v-if="form.errors.roles" class="text-red-500 text-sm">{{ form.errors.roles }}</p>
                    </div>

                    <Button type="submit" :disabled="form.processing">Atualizar Usuário</Button>
                </form>
            </div>
        </div>
        <div v-else>
            <p class="p-6 text-red-500">Erro: Dados do usuário ou roles não carregados.</p>
        </div>
    </AppLayout>
</template>

<style scoped>
.space-y-4 > * + * {
    margin-top: 1rem;
}
.space-y-2 > * + * {
    margin-top: 0.5rem;
}
</style>
