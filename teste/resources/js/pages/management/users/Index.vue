<script setup>
import { Button } from '@/components/ui/button';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    users: Object,
});

const form = useForm({});

const deleteUser = (id) => {
    if (confirm('Tem certeza que deseja excluir este usuário?')) {
        form.delete(route('users.destroy', id), {
            preserveScroll: true,
            onSuccess: () => form.reset(),
        });
    }
};
</script>

<template>
    <Head title="Gerenciar Usuários" />
    <AppLayout>
        <div class="p-6">
            <div class="mb-6 flex items-center justify-between">
                <h1 class="text-2xl font-bold">Usuários</h1>
                <Link :href="route('users.create')" preserve-scroll>
                    <Button>Novo Usuário</Button>
                </Link>
            </div>

            <div class="overflow-x-auto">
                <Table>
                    <TableHeader>
                        <TableRow>
                            <TableHead>ID</TableHead>
                            <TableHead>Nome</TableHead>
                            <TableHead>Email</TableHead>
                            <TableHead>Perfis</TableHead>
                            <TableHead>Ações</TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow v-for="user in props.users.data" :key="user.id">
                            <TableCell>{{ user.id }}</TableCell>
                            <TableCell>{{ user.name }}</TableCell>
                            <TableCell>{{ user.email }}</TableCell>
                            <TableCell>
                                <span v-if="user.roles && user.roles.length > 0">
                                    {{ user.roles.map((role) => role.name || 'Nome inválido').join(', ') }}
                                </span>
                                <span v-else>Sem perfis</span>
                            </TableCell>
                            <TableCell>
                                <Link :href="route('users.edit', user.id)" preserve-scroll>
                                    <Button variant="outline" size="sm" class="mr-2">Editar</Button>
                                </Link>
                                <Button variant="destructive" size="sm" @click="deleteUser(user.id)">Excluir</Button>
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
            </div>

            <div class="mt-4 flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-700">Mostrando {{ props.users.from }} a {{ props.users.to }} de {{ props.users.total }} usuários</p>
                </div>
                <div class="flex gap-2">
                    <Link :href="props.users.prev_page_url" :disabled="!props.users.prev_page_url" preserve-scroll>
                        <Button variant="outline" :disabled="!props.users.prev_page_url">Anterior</Button>
                    </Link>
                    <Link :href="props.users.next_page_url" :disabled="!props.users.next_page_url" preserve-scroll>
                        <Button variant="outline" :disabled="!props.users.next_page_url">Próximo</Button>
                    </Link>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
.overflow-x-auto {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

table {
    min-width: 100%;
    table-layout: auto;
}

a {
    text-decoration: none;
}

button:disabled {
    cursor: not-allowed;
    opacity: 0.6;
}
</style>
