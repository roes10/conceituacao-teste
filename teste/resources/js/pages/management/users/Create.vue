<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
    roles: Array,
});

const form = useForm({
    name: '',
    email: '',
    password: '',
    roles: [],
});

const submit = () => {
    form.post(route('users.store'), {
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <Head title="Criar Usuário" />
    <AppLayout>
        <div class="p-6">
            <h1 class="mb-6 text-2xl font-bold">Criar Novo Usuário</h1>

            <form @submit.prevent="submit" class="max-w-md space-y-4">
                <div>
                    <Label for="name">Nome</Label>
                    <Input id="name" v-model="form.name" type="text" required />
                    <p v-if="form.errors.name" class="text-sm text-red-500">{{ form.errors.name }}</p>
                </div>

                <div>
                    <Label for="email">Email</Label>
                    <Input id="email" v-model="form.email" type="email" required />
                    <p v-if="form.errors.email" class="text-sm text-red-500">{{ form.errors.email }}</p>
                </div>

                <div>
                    <Label for="password">Senha</Label>
                    <Input id="password" v-model="form.password" type="password" required />
                    <p v-if="form.errors.password" class="text-sm text-red-500">{{ form.errors.password }}</p>
                </div>

                <div>
                    <Label for="roles">Perfis</Label>
                    <Select v-model="form.roles" multiple>
                        <SelectTrigger>
                            <SelectValue placeholder="Selecione os perfis" />
                        </SelectTrigger>
                        <SelectContent>
                            <SelectItem v-for="role in roles" :key="role.id" :value="role.id">
                                {{ role.name }}
                            </SelectItem>
                        </SelectContent>
                    </Select>
                    <p v-if="form.errors.roles" class="text-sm text-red-500">{{ form.errors.roles }}</p>
                </div>

                <Button type="submit" :disabled="form.processing">Criar Usuário</Button>
            </form>
        </div>
    </AppLayout>
</template>
