<div class="navbar navbar-fixed-bottom">
	<div class="navbar-inner">
		<div class="container">
			<ul id="context-options" class="nav">
				<li class="active">
					<?php echo $this->Html->link('Visualizar usuário', '/users'); ?>
				</li>
				<li>
					<?php echo $this->Html->link('Adicionar usuário', '/users/add'); ?>
				</li>
				<li>
					<?php echo $this->Html->link('Permissões', '/users/permissions'); ?>
				</li>
			</ul>
		</div>
	</div>
</div>

<div class="content-block container-fluid">

	<div class="row-fluid content-title">
		<h2>Usuários</h2>
	</div>

	<div class="row-fluid">
		<div class="span12">
			<?php if (isset($success_message)): ?>
				<div class='alert alert-success'>
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Sucesso!</strong> Usuário <?php if ($success_message == 'edit') echo 'atualizado'; elseif ($success_message == 'add') echo 'adicionado'; elseif ($success_message == 'delete') echo 'deletado' ?> com sucesso!
				</div>
			<?php endif; ?>
				<?php echo $this->Form->create(null, array('class' => 'form-search well search-box', 'type' => 'get'));
					  echo $this->Form->input("Buscar usuário: ", array('div' => false, 'class' => 'input-large search-query', 'label' => array('class' => 'control-label'), 'name' => 'search', 'id' => 'search-input', 'value' => ($this->request->query['search'] ? $this->request->query['search'] : '')));
					  echo $this->Form->submit("Buscar", array('class' => 'btn', 'div' => false));
					  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'icon-plus icon-white')).' Adicionar novo usuário', 'add', array('class' => 'btn btn-success pull-right', 'escape' => false));
					  echo $this->Form->end();
				?>
		</div>
	</div>

	<div class="row-fluid">
		<table class="table table-striped table-bordered table-sortable">
			<thead>
				<tr>
					<th><?php echo $this->Html->link('Nome', array('?' => array('search' => $this->request->query['search'], 'sort' => 'name', 'asc' => ($this->request->query['asc'] == 'true' ? 'false' : 'true')))); ?></th>
					<th><?php echo $this->Html->link('E-mail', array('?' => array('search' => $this->request->query['search'], 'sort' => 'email', 'asc' => ($this->request->query['asc'] == 'true' ? 'false' : 'true')))); ?></th>
					<th><?php echo $this->Html->link('Tipo de usuário', array('?' => array('search' => $this->request->query['search'], 'sort' => 'type', 'asc' => ($this->request->query['asc'] == 'true' ? 'false' : 'true')))); ?></th>
					<th style="width: 110px">Opções</th>
				</tr>
			</thead>
			<tbody>
				<?php if (!empty($users)) foreach ($users as $user): ?>
					<tr>
						<td>
							<?php echo $this->Html->link($user['User']['name'], array('controller' => 'users', 'action' => 'show', $user['User']['id'])); ?>
						</td>
						<td>
							<?php echo $user['User']['email'] ?>
						</td>
						<td>
							<?php echo $user['User']['user_type'] ?>
						</td>
						<td>
							<?php echo $this->Html->link('Editar', array('controller' => 'users', 'action' => 'edit', $user['User']['id']), array('class' => 'btn btn-mini', 'style' => 'margin-right: 6px'));
							      echo $this->Form->postLink('Remover', array('controller' => 'users', 'action' => 'delete', $user['User']['id']), array('class' => 'btn btn-mini btn-danger'), 'Você está certo disso?'); ?>
						</td>
					</tr>	
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>