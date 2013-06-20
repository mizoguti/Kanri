<?php $this->Html->script('candidate.js', array('inline' => false)); ?>

<div class="navbar navbar-fixed-bottom">
	<div class="navbar-inner">
		<div class="container">
			<ul id="context-options" class="nav">
				<li class="active">
					<?php echo $this->Html->link('Visualizar candidatos', '/candidates'); ?>
				</li>
				<li>
					<?php echo $this->Html->link('Busca avançada de candidatos', '/candidates/search'); ?>
				</li>
				<li>
					<?php echo $this->Html->link('Adicionar candidatos', '/candidates/add'); ?>
				</li>
			</ul>
		</div>
	</div>
</div>

<div class="content-block container-fluid">

	<div class="row-fluid content-title">
		<h2>Atualizar candidato</h2>
	</div>

	<div class="row-fluid">
		<?php echo $this->Form->create('Candidate', array('class' => 'form-horizontal', 'type' => 'file')); ?>
			<fieldset>
				<legend>Dados pessoais</legend>
				<div class="control-group">
					<?php echo $this->Form->label('Candidate.first_name', 'Primeiro nome: ', array('div' => false, 'class' => 'control-label')); ?>
					<div class='controls'>
						<?php echo $this->Form->input('Candidate.first_name', array('div' => false, 'label' => false)); ?>
					</div>
					<div class="control-group-internal-divider"></div>
					<?php echo $this->Form->label('Candidate.middle_names', 'Nomes complementares: ', array('div' => false, 'class' => 'control-label')); ?>
					<div class='controls'>
						<?php echo $this->Form->input('Candidate.middle_names', array('div' => false, 'label' => false, 'class' => 'input-xxlarge')); ?>
					</div>
					<div class="control-group-internal-divider"></div>
					<?php echo $this->Form->label('Candidate.last_name', 'Sobrenome: ', array('div' => false, 'class' => 'control-label')); ?>
					<div class='controls'>
						<?php echo $this->Form->input('Candidate.last_name', array('div' => false, 'label' => false)); ?>
					</div>
					<?php echo $this->Form->input('Candidate.id', array('div' => false, 'label' => false, 'type' => 'hidden')); ?>
				</div>
				<div class="control-group">
					<?php echo $this->Form->label('Candidate.gender', 'Sexo: ', array('div' => false, 'class' => 'control-label')); ?>
					<div class="controls">
						<label class="radio inline">
							<input type="radio" name="data[Candidate][gender]" id="CandidateGenderMale" value="0" checked/>Masculino
						</label>
						<label class="radio inline">
							<input type="radio" name="data[Candidate][gender]" id="CandidateGenderFemale" value="1" />Feminino
						</label>
					</div>
					<div class="control-group-internal-divider"></div>
					<?php echo $this->Form->label('Candidate.civil_state', 'Estado civil: ', array('div' => false, 'class' => 'control-label')); ?>
					<div class="controls">
						<?php echo $this->Form->input('Candidate.civil_state', array('options' => array('0' => 'Solteiro', '1' => 'Casado', '2' => 'Divorciado', '3' => 'Viúvo'), 'div' => false, 'label' => false)); ?>
					</div>
				</div>
				<div class="control-group">
					<?php echo $this->Form->label('Candidate.place_birth', 'Naturalidade: ', array('div' => false, 'class' => 'control-label')); ?>
					<div class='controls'>
						<?php echo $this->Form->input('Candidate.place_birth', array('div' => false, 'label' => false)); ?>
					</div>
				</div>
				<div class="control-group">
					<?php echo $this->Form->label(null, 'Dependentes: ', array('div' => false, 'class' => 'control-label')); ?>
					<div class="controls">
						<table class='table table-striped table-bordered' style='width: 350px'>
							<thead>
								<tr>
									<th style='text-align: center'>Idade</th>
									<th style='text-align: center'>Sexo</th>
									<th style='width: 28px'></th>
								</tr>
							</thead>
							<tbody id='dependent-table'>
								<?php foreach ($this->request->data['Dependent'] as $dependent): ?>
								<tr>
									<td style="text-align: center">
										<?php echo $dependent['age']; ?>
									</td>
									<td style="text-align: center">
										<?php echo $dependent['gender_string']; ?>
									</td>
									<td>
										<button type="button" class="btn btn-mini btn-danger" onclick="Candidate.removeDependent(this)"><i class="icon-remove icon-white"></i></button>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
						<?php echo $this->Form->label(null, 'Idade: ', array('div' => false, 'style' => 'display: inline'));
							  echo $this->Form->input(null, array('div' => false, 'label' => false, 'class' => 'input-small', 'style' => 'margin-left: 10px', 'id' => 'dependent-age-input', 'name' => false, 'value' => ''));
							  echo $this->Form->label(null, 'Sexo: ', array('div' => false, 'style' => 'display: inline; margin-left: 10px'));
							  echo $this->Form->input(null, array('div' => false, 'label' => false, 'options' => array('0' => 'Masculino', '1' => 'Feminino'), 'style' => 'margin-left: 10px', 'id' => 'dependent-gender-input', 'name' => false));
						      echo $this->Form->button('Adicionar dependente', array('class' => 'btn btn-primary', 'style' => 'margin-left: 10px', 'onclick' => 'Candidate.addDependent()', 'type' => 'button')); ?>
						<div id='dependent-inputs' style='display: none'>
							<?php foreach ($this->request->data['Dependent'] as $index => $dependent): ?>
								<input class="candidate-dependent-age" type="hidden" name="data[Dependent][<?php echo $index; ?>][age]" value="<?php echo $dependent['age']; ?>" index="<?php echo $index; ?>" />
								<input class="candidate-dependent-gender" type="hidden" name="data[Dependent][<?php echo $index; ?>][gender]" value="<?php echo $dependent['gender']; ?>" index="<?php echo $index; ?>" />
							<?php endforeach; ?>	
						</div>
					</div>
				</div>
				<div class="control-group">
					<?php echo $this->Form->label('Candidate.birthdate', 'Data de nascimento: ', array('div' => false, 'class' => 'control-label')); ?>
					<div class='controls'>
						<?php echo $this->Form->input('Candidate.birthdate', array('div' => false, 'label' => false, 'placeholder' => 'dd/MM/yyyy', 'type' => 'text')); ?>
					</div>
				</div>
				<div class="control-group">
					<?php echo $this->Form->label('Candidate.address', 'Endereço residencial: ', array('div' => false, 'class' => 'control-label')); ?>
					<div class='controls'>
						<?php echo $this->Form->input('Candidate.address', array('div' => false, 'label' => false, 'class' => 'input-xxlarge')); ?>
					</div>
					<div class="control-group-internal-divider"></div>
					<?php echo $this->Form->label('Candidate.neighborhood', 'Bairro: ', array('div' => false, 'class' => 'control-label')); ?>
					<div class='controls'>
						<?php echo $this->Form->input('Candidate.neighborhood', array('div' => false, 'label' => false)); ?>
					</div>
					<div class="control-group-internal-divider"></div>
					<?php echo $this->Form->label('Candidate.zip_code', 'CEP ou Zip Code: ', array('div' => false, 'class' => 'control-label')); ?>
					<div class='controls'>
						<?php echo $this->Form->input('Candidate.zip_code', array('div' => false, 'label' => false)); ?>
					</div>
					<div class="control-group-internal-divider"></div>
					<?php echo $this->Form->label('City.State.Country.id', 'País: ', array('div' => false, 'class' => 'control-label')); ?>
					<div class='controls'>
						<?php echo $this->Form->input('City.State.Country.id', array('div' => false, 'label' => false, 'options' => $countries, 'empty' => 'Selecione...', 'onchange' => 'Candidate.selectCountry(this)'));
							  echo $this->Form->label('City.State.Country.name', 'Qual? ', array('div' => false, 'style' => 'display: none; margin-left: 10px', 'id' => 'country-name-label'));
							  echo $this->Form->input('City.State.Country.name', array('div' => false, 'label' => false, 'style' => 'display: none; margin-left: 10px', 'id' => 'country-name-input')); ?>
					</div>
					<div class="control-group-internal-divider" id='state-divider'></div>
					<?php echo $this->Form->label('City.State.id', 'Estado / Província: ', array('div' => false, 'class' => 'control-label', 'id' => 'state-label')); ?>
					<div class='controls'>
						<?php echo $this->Form->input('City.State.id', array('div' => false, 'label' => false, 'options' => $states, 'empty' => 'Selecione...', 'onchange' => 'Candidate.selectState(this)', 'id' => 'state-input'));
							  echo $this->Form->label('City.State.name', 'Qual? ', array('div' => false, 'style' => 'display: none; margin-left: 10px; margin-right: 10px', 'id' => 'state-name-label'));
							  echo $this->Form->input('City.State.name', array('div' => false, 'label' => false, 'style' => 'display: none', 'id' => 'state-name-input')); ?>
					</div>
					<div class="control-group-internal-divider" id='city-divider'></div>
					<?php echo $this->Form->label('City.id', 'Cidade: ', array('div' => false, 'class' => 'control-label', 'id' => 'city-label')); ?>
					<div class='controls'>
						<?php echo $this->Form->input('City.id', array('div' => false, 'label' => false, 'options' => $cities, 'empty' => 'Selecione...', 'onchange' => 'Candidate.selectCity(this)', 'id' => 'city-input'));
							  echo $this->Form->label('City.name', 'Qual? ', array('div' => false, 'style' => 'display: none; margin-left: 10px; margin-right: 10px', 'id' => 'city-name-label'));
							  echo $this->Form->input('City.name', array('div' => false, 'label' => false, 'style' => 'display: none', 'id' => 'city-name-input')); ?>
					</div>
				</div>
				<div class="control-group">
					<?php echo $this->Form->label('Candidate.home_phone', 'Telefone residencial: ', array('div' => false, 'class' => 'control-label')); ?>
					<div class='controls'>
						<?php echo $this->Form->input('Candidate.home_phone', array('div' => false, 'label' => false)); ?>
					</div>
					<div class="control-group-internal-divider"></div>
					<?php echo $this->Form->label('Candidate.work_phone', 'Telefone comercial: ', array('div' => false, 'class' => 'control-label')); ?>
					<div class='controls'>
						<?php echo $this->Form->input('Candidate.work_phone', array('div' => false, 'label' => false)); ?>
					</div>
					<div class="control-group-internal-divider"></div>
					<?php echo $this->Form->label('Candidate.mobile_phone', 'Celular: ', array('div' => false, 'class' => 'control-label')); ?>
					<div class='controls'>
						<?php echo $this->Form->input('Candidate.mobile_phone', array('div' => false, 'label' => false)); ?>
					</div>
				</div>
				<div class="control-group">
					<?php echo $this->Form->label('Candidate.personal_email', 'E-mail pessoal: ', array('div' => false, 'class' => 'control-label')); ?>
					<div class='controls'>
						<?php echo $this->Form->input('Candidate.personal_email', array('div' => false, 'label' => false)); ?>
					</div>
					<div class="control-group-internal-divider"></div>
					<?php echo $this->Form->label('Candidate.work_email', 'E-mail comercial: ', array('div' => false, 'class' => 'control-label')); ?>
					<div class='controls'>
						<?php echo $this->Form->input('Candidate.work_email', array('div' => false, 'label' => false)); ?>
					</div>
					<div class="control-group-internal-divider"></div>
					<?php echo $this->Form->label('Candidate.skype_name', 'Nome Skype: ', array('div' => false, 'class' => 'control-label')); ?>
					<div class='controls'>
						<?php echo $this->Form->input('Candidate.skype_name', array('div' => false, 'label' => false)); ?>
					</div>
				</div>
			</fieldset>

			<fieldset>
				<legend>Formação acadêmica</legend>
				<div class="control-group">
					<div class="controls">
						<ul id="formation-list">
							<?php foreach ($this->request->data['CandidateFormation'] as $formation): ?>
							<li style='margin-bottom: 10px' editing='false'>
								<strong>
									<span class='formation-name'>
										<?php echo $formation['Formation']['name']; ?>
									</span>
								</strong>
								<br />
								<span class='formation-institution'>
									<?php echo $formation['institution']; ?>
								</span>
								<br />
								Conclusão em: 
								<span class='formation-year'>
									<?php echo $formation['conclusion_year']; ?>
								</span>
								<br />
								<button type='button' class='btn btn-primary btn-mini formation-edit-btn' style='margin-top: 5px' onclick='Candidate.editCandidateFormation(this)'><i class='icon-edit icon-white'></i>
								</button>
								<button class='btn btn-danger btn-mini formation-remove-btn' type='button' onclick='Candidate.removeCandidateFormation(this)' style='margin-top: 5px'><i class='icon-remove icon-white'></i>
								</button>
							</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
				<div class="control-group">
					<?php echo $this->Form->label(null, 'Tipo de formação: ', array('div' => false, 'class' => 'control-label')); ?>
					<div class="controls">
						<div class="input-append">
							<span id="formation-name-input" class="input-xxlarge uneditable-input"></span>
							<button class="btn" type="button" data-toggle="modal" data-target="#formation-modal"><i class="icon-search"></i></button>
						</div>
						<?php echo $this->Form->input(null, array('type' => 'hidden', 'div' => false, 'label' => false, 'id' => 'formation-input', 'name' => false)); ?>
					</div>
					<div class="control-group-internal-divider"></div>
					<?php echo $this->Form->label(null, 'Instituição: ', array('div' => false, 'class' => 'control-label')); ?>
					<div class='controls'>
						<?php echo $this->Form->input(null, array('div' => false, 'label' => false, 'class' => 'input-xxlarge', 'id' => 'formation-institution-input', 'name' => false, 'value' => '')); ?>
					</div>
					<div class="control-group-internal-divider"></div>
					<?php echo $this->Form->label(null, 'Ano de conclusão: ', array('div' => false, 'class' => 'control-label')); ?>
					<div class='controls'>
						<?php echo $this->Form->input(null, array('div' => false, 'label' => false, 'class' => 'input-small', 'id' => 'formation-year-input', 'placeholder' => 'AAAA', 'name' => false, 'value' => '')); ?>
					</div>
					<br />
					<div class="controls">
						<button type='button' class="btn btn-primary" id="add-formation-btn" onclick='Candidate.addCandidateFormation()'><i class="icon-plus icon-white"></i> Adicionar formação</button>
						<button type='button' class="btn btn-primary" id="update-formation-btn" style="display: none" onclick="Candidate.updateCandidateFormation()"><i class="icon-edit icon-white"></i> Atualizar formação</a>
						<button type='button' class="btn" id="update-formation-cancel-btn" style="display: none; margin-left: 10px" onclick="Candidate.cancelEditCandidateFormation()">Cancelar</a>
					</div>
				</div>
				<div id='candidate-formation-inputs'>
					<?php foreach ($this->request->data['CandidateFormation'] as $index => $formation): ?>
						<input type="hidden" name="data[CandidateFormation][<?php echo $index; ?>][formation_id]" class="formation-id-input" value="<?php echo $formation['Formation']['id']; ?>" index="<?php echo $index; ?>" />
						<input type="hidden" name="data[CandidateFormation][<?php echo $index; ?>][institution]" class="formation-institution-input" value="<?php echo $formation['institution']; ?>" index="<?php echo $index; ?>" />
						<input type="hidden" name="data[CandidateFormation][<?php echo $index; ?>][conclusion_year]" class="formation-year-input" value="<?php echo $formation['conclusion_year']; ?>" index="<?php echo $index; ?>" />
					<?php endforeach; ?>
				</div>
			</fieldset>

			<fieldset>
				<legend>Idiomas</legend>
				<div class="control-group">
					<div class="controls">
						<ul id="language-list">
							<?php foreach($this->request->data['CandidateLanguage'] as $language): ?>
							<li style='margin-bottom: 5px'>
								<strong><?php echo $language['Language']['name'].':'; ?></strong>
								<?php echo $language['level_string']; ?>
								<button type='button' class='btn btn-danger btn-mini btn-micro language-remove-btn' onclick='Candidate.removeCandidateLanguage(this)'>X</button>
							</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
				<div class="control-group">
					<?php echo $this->Form->label(null, 'Idioma: ', array('div' => false, 'class' => 'control-label')); ?>
					<div class="controls">
						<?php echo $this->Form->input(null, array('id' => 'language-input', 'options' => $languages, 'empty' => 'Selecione...', 'div' => false, 'label' => false, 'onchange' => 'Candidate.selectLanguage(this)', 'name' => false));
							  echo $this->Form->label(null, 'Qual? ', array('div' => false, 'style' => 'display: none; margin-left: 10px; margin-right: 10px', 'id' => 'language-name-label'));
						      echo $this->Form->input(null, array('id' => 'language-name-input', 'class' => 'input-xlarge', 'style' => 'display: none', 'type' => 'text', 'div' => false, 'label' => false, 'name' => false)); ?>
					</div>
					<div class="control-group-internal-divider"></div>
					<?php echo $this->Form->label(null, 'Nível ', array('div' => false, 'class' => 'control-label')); ?>
					<div class="controls">
						<label class="radio inline">
							<input type="radio" name="language-level" value="0" label="Básico" checked />Básico
						</label>
						<label class="radio inline">
							<input type="radio" name="language-level" value="1" label="Intermediário" /> Intermediário
						</label>
						<label class="radio inline">
							<input type="radio" name="language-level" value="2" label="Avançado" /> Avançado
						</label>
						<label class="radio inline">
							<input type="radio" name="language-level" value="3" label="Fluente" /> Fluente
						</label>
					</div>
					<br />
					<div class="controls">
						<?php echo $this->Form->button($this->Html->tag('i', '', array('class' => 'icon-plus icon-white')).' Adicionar idioma', array('class' => 'btn btn-primary', 'type' => 'button', 'onclick' => "Candidate.addCandidateLanguage()")); ?>
					</div>
					<div id='candidate-language-inputs'>
						<?php foreach($this->request->data['CandidateLanguage'] as $index => $language): ?>
							<input type="hidden" class="language-input language-id-input" name="data[CandidateLanguage][<?php echo $index; ?>][language_id]" value="<?php echo $language['Language']['id']; ?>" index="<?php echo $index; ?>" />
							<input type="hidden" class="language-level-input" name="data[CandidateLanguage][<?php echo $index; ?>][level]" value="<?php echo $language['level']; ?>" index="<?php echo $index; ?>" />
						<?php endforeach; ?>
					</div>
				</div>
			</fieldset>

			<fieldset>
				<legend>Cursos e especializações</legend>
				<div class="control-group">
					<div class="controls">
						<ul id="course-list">
							<?php foreach ($this->request->data['CandidateCourse'] as $course): ?>
							<li style='margin-bottom: 10px' editing='false'>
								<strong>
									<span class='course-name'>
										<?php echo $course['Course']['name']; ?>
									</span>
								</strong>
								<br />
								<span class='course-institution'>
									<?php echo $course['institution']; ?>
								</span>
								<br />
								Conclusão em: 
								<span class='course-year'>
									<?php echo $course['conclusion_year']; ?>
								</span>
								<br />
								<button type='button' class='btn btn-primary btn-mini course-edit-btn' style='margin-top: 5px' onclick='Candidate.editCandidateCourse(this)'><i class='icon-edit icon-white'></i>
								</button>
								<button class='btn btn-danger btn-mini course-remove-btn' type='button' onclick='Candidate.removeCandidateCourse(this)' style='margin-top: 5px'><i class='icon-remove icon-white'></i></button>
							</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
				<div class="control-group">
					<?php echo $this->Form->label('CandidateCourse', 'Curso / Especialização: ', array('div' => false, 'class' => 'control-label')); ?>
					<div class="controls">
						<div class="input-append">
							<span id="course-name-input" class="input-xxlarge uneditable-input"></span>
							<button class="btn" type="button" data-toggle="modal" data-target="#course-modal"><i class="icon-search"></i></button>
						</div>
						<?php echo $this->Form->input(null, array('type' => 'hidden', 'div' => false, 'label' => false, 'id' => 'course-input', 'name' => false, 'value' => '')); ?>
					</div>
					<div class="control-group-internal-divider"></div>
					<?php echo $this->Form->label(null, 'Instituição: ', array('div' => false, 'class' => 'control-label')); ?>
					<div class='controls'>
						<?php echo $this->Form->input(null, array('div' => false, 'label' => false, 'class' => 'input-xxlarge', 'id' => 'course-institution-input', 'name' => false, 'value' => '')); ?>
					</div>
					<div class="control-group-internal-divider"></div>
					<?php echo $this->Form->label(null, 'Ano de conclusão: ', array('div' => false, 'class' => 'control-label')); ?>
					<div class='controls'>
						<?php echo $this->Form->input(null, array('div' => false, 'label' => false, 'class' => 'input-small', 'id' => 'course-year-input', 'placeholder' => 'AAAA', 'name' => false, 'value' => '')); ?>
					</div>
					<br />
					<div class="controls">
						<button type='button' class="btn btn-primary" id="add-course-btn" onclick='Candidate.addCandidateCourse()'><i class="icon-plus icon-white"></i> Adicionar curso / especialização</button>
						<button type='button' class="btn btn-primary" id="update-course-btn" style="display: none" onclick="Candidate.updateCandidateCourse()"><i class="icon-edit icon-white"></i> Atualizar curso / especialização</a>
						<button type='button' class="btn" id="update-course-cancel-btn" style="display: none; margin-left: 10px" onclick="Candidate.cancelEditCandidateCourse()">Cancelar</a>
					</div>
					<div id='candidate-course-inputs'>
						<?php foreach ($this->request->data['CandidateCourse'] as $index => $course): ?>
						<input type="hidden" name="data[CandidateCourse][<?php echo $index; ?>][course_id]" class="course-id-input" value="<?php echo $course['Course']['id']; ?>" index="<?php echo $index; ?>" />
						<input type="hidden" name="data[CandidateCourse][<?php echo $index; ?>][institution]" class="course-institution-input" value="<?php echo $course['institution']; ?>" index="<?php echo $index; ?>" />
						<input type="hidden" name="data[CandidateCourse][<?php echo $index; ?>][conclusion_year]" class="course-year-input" value="<?php echo $course['conclusion_year']; ?>" index="<?php echo $index; ?>" />
						<?php endforeach; ?>
					</div>
				</div>
			</fieldset>

			<fieldset>
				<legend>Experiência internacional</legend>
				<div class="control-group">
					<div class="controls">
						<?php echo $this->Form->input('Candidate.international_experience', array('div' => false, 'label' => false)); ?>
					</div>
				</div>
			</fieldset>

			<fieldset>
				<legend>Informações adicionais</legend>
				<div class="control-group">
					<div class="controls">
						<?php echo $this->Form->input('Candidate.additional_info', array('div' => false, 'label' => false, 'class' => 'input-xxlarge', 'placeholder' => 'Ex: CRC ativo, OAB, etc...')); ?>
					</div>
				</div>
			</fieldset>

			<fieldset>
				<legend>Remuneração</legend>
				<div class="control-group">
					<?php echo $this->Form->label('Candidate.income_type', 'Tipo de salário: ', array('div' => false, 'class' => 'control-label')); ?>
					<div class="controls">
						<?php echo $this->Form->input('Candidate.income_type', array('div' => false, 'label' => false, 'class' => 'input-medium', 'options' => array('0' => 'CLT', '1' => 'PJ', '2' => 'CLT e PJ'), 'empty' => 'Selecione...', 'onchange' => 'Candidate.selectIncomeType(this)')); ?>
					</div>
					<div class="control-group-internal-divider income-clt-field" style='display: none'></div>
					<?php echo $this->Form->label('Candidate.income_clt', 'Salário CLT (em R$): ', array('div' => false, 'class' => 'control-label income-clt-field', 'style' => 'display: none')); ?>
					<div class="controls">
						<?php echo $this->Form->input('Candidate.income_clt', array('div' => 'false', 'label' => false, 'style' => 'display: none', 'class' => 'income-clt-field', 'step' => '0.01', 'min' => '0')); ?>
					</div>
					<div class="control-group-internal-divider income-pj-field" style='display: none'></div>
					<?php echo $this->Form->label('Candidate.income_pj', 'Salário PJ (em R$): ', array('div' => false, 'class' => 'control-label income-pj-field', 'style' => 'display: none')); ?>
					<div class="controls">
						<?php echo $this->Form->input('Candidate.income_pj', array('div' => 'false', 'label' => false, 'style' => 'display: none', 'class' => 'income-pj-field', 'step' => '0.01', 'min' => '0')); ?>
					</div>
					<div class="control-group-internal-divider"></div>
					<?php echo $this->Form->label('Candidate.income_bonus', 'Bônus: ', array('div' => false, 'class' => 'control-label')); ?>
					<div class='controls'>
						<?php echo $this->Form->input('Candidate.income_bonus', array('div' => false, 'label' => false)); ?>
					</div>
				</div>
				<div class="control-group">
					<?php echo $this->Form->label('Candidate.health_insurance_name', 'Seguro de saúde: ', array('div' => false, 'class' => 'control-label')); ?>
					<div class='controls'>
						<?php echo $this->Form->input('Candidate.health_insurance_name', array('div' => false, 'label' => false, 'class' => 'input-xxlarge')); ?>
					</div>
					<div class="control-group-internal-divider"></div>
					<?php echo $this->Form->label('Candidate.health_insurance_type', 'Acomodação: ', array('div' => false, 'class' => 'control-label')); ?>
					<div class='controls'>
						<?php echo $this->Form->input('Candidate.health_insurance_type', array('div' => false, 'label' => false, 'options' => array('0' => 'Quarto privativo', '1' => 'Quarto coletivo', '2' => 'Enfermaria'), 'empty' => 'Selecione...')); ?>
					</div>
				</div>
				<div class="control-group">
					<?php echo $this->Form->label('Candidate.life_insurance_name', 'Seguro de vida: ', array('div' => false, 'class' => 'control-label')); ?>
					<div class='controls'>
						<?php echo $this->Form->input('Candidate.life_insurance_name', array('div' => false, 'label' => false, 'class' => 'input-xxlarge')); ?>
					</div>
					<div class="control-group-internal-divider"></div>
					<?php echo $this->Form->label('Candidate.life_insurance_coverage', 'Cobertura: ', array('div' => false, 'class' => 'control-label')); ?>
					<div class='controls'>
						<?php echo $this->Form->input('Candidate.life_insurance_coverage', array('div' => false, 'label' => false, 'class' => 'input-large'));
							  echo $this->Form->input('Candidate.life_insurance_type', array('div' => false, 'label' => false, 'style' => 'margin-left: 10px', 'options' => array('0' => 'R$', '1' => 'Múltiplo de salário'))); ?>
					</div>
				</div>
				<div class="control-group">
					<?php echo $this->Form->label('Candidate.dental_insurance', 'Seguro odontológico: ', array('div' => false, 'class' => 'control-label')); ?>
					<div class='controls'>
						<?php echo $this->Form->input('Candidate.dental_insurance', array('div' => false, 'label' => false, 'class' => 'input-xxlarge')); ?>
					</div>
					<div class="control-group-internal-divider"></div>
					<?php echo $this->Form->label('Candidate.private_pension', 'Previdência privada: ', array('div' => false, 'class' => 'control-label')); ?>
					<div class='controls'>
						<?php echo $this->Form->input('Candidate.private_pension', array('div' => false, 'label' => false, 'class' => 'input-xxlarge')); ?>
					</div>
				</div>
				<div class="control-group">
					<?php echo $this->Form->label('Candidate.meal_ticket_value', 'Vale refeição: ', array('div' => false, 'class' => 'control-label')); ?>
					<div class="controls">
						<?php echo $this->Form->input('Candidate.meal_ticket_type', array('div' => false, 'label' => false, 'options' => array('0' => 'R$/dia', '1' => 'R$/mês'), 'class' => 'input-small'));
							  echo $this->Form->input('Candidate.meal_ticket_value', array('div' => false, 'label' => false, 'style' => 'margin-left: 10px', 'class' => 'input-large')); ?>	
					</div>
					<div class="control-group-internal-divider"></div>
					<?php echo $this->Form->label('Candidate.vehicle_description', 'Veículo: ', array('div' => false, 'class' => 'control-label')); ?>
					<div class="controls">
						<?php echo $this->Form->input('Candidate.vehicle_type', array('div' => false, 'label' => false, 'options' => array('0' => 'Veículo', '1' => 'Valor (em R$)')));
							  echo $this->Form->input('Candidate.vehicle_description', array('div' => false, 'label' => false, 'style' => 'margin-left: 10px', 'class' => 'input-large')); ?>	
					</div>	
					<div class="control-group-internal-divider"></div>
					<?php echo $this->Form->label('Candidate.fuel_voucher', 'Vale combustível: ', array('div' => false, 'class' => 'control-label')); ?>
					<div class='controls'>
						<?php echo $this->Form->input('Candidate.fuel_voucher', array('div' => false, 'label' => false, 'class' => 'input-large')); ?>
					</div>
					<div class="control-group-internal-divider"></div>
					<?php echo $this->Form->label('Candidate.market_basket', 'Cesta básica: ', array('div' => false, 'class' => 'control-label')); ?>
					<div class='controls'>
						<?php echo $this->Form->input('Candidate.market_basket', array('div' => false, 'label' => false, 'class' => 'input-large')); ?>
					</div>	
				</div>
				<div class="control-group">
					<?php echo $this->Form->label('Candidate.training_courses', 'Treinamentos: ', array('div' => false, 'class' => 'control-label')); ?>
					<div class='controls'>
						<?php echo $this->Form->input('Candidate.training_courses', array('div' => false, 'label' => false, 'class' => 'input-xxlarge')); ?>
					</div>
				</div>
				<div class="control-group">
					<?php echo $this->Form->label('Candidate.profit_sharing', 'PLR: ', array('div' => false, 'class' => 'control-label')); ?>
					<div class='controls'>
						<?php echo $this->Form->input('Candidate.profit_sharing', array('div' => false, 'label' => false, 'class' => 'input-xlarge')); ?>
					</div>
				</div>
			</fieldset>

			<fieldset>
				<legend>Comentários do consultor</legend>
				<div class="control-group">
					<div class="controls">
						<?php echo $this->Form->input('Candidate.comments', array('div' => false, 'label' => false)); ?>
					</div>
				</div>
			</fieldset>

			<fieldset>
				<legend>Experiênciais profissionais</legend>
				<div class="control-group">
					<div class="controls">
						<h4>Principais realizações</h4>
						<ul id="experience-list" class="experience-list">
							<?php $index = 0; ?> 
							<?php foreach ($this->request->data['Experience'] as $workplace_id => $workplace): ?>
								<li workplace-id="<?php echo $workplace_id; ?>" workplace-name="<?php echo $workplace[0]['Workplace']['name']; ?>" workplace-nationality="<?php echo $workplace[0]['Workplace']['nationality']; ?>" workplace-market-sector="<?php echo $workplace[0]['Workplace']['MarketSector']['name']; ?>" editing="false">
									<strong>Empresa: <?php echo $workplace[0]['Workplace']['name']; ?></strong>
									<br />
									<span class='workplace-details'><?php echo 'Empresa '.$workplace[0]['Workplace']['nationality'].' - Segmento '.$workplace[0]['Workplace']['MarketSector']['name']; ?></span>
									<br />
									<button class='btn btn-primary btn-mini workplace-edit-btn' onclick='Candidate.editWorkplace(this)' type='button'><i class='icon-edit icon-white'></i></button>
									<button class='btn btn-danger btn-mini workplace-remove-btn' onclick='Candidate.removeWorkplace(this)'><i class='icon-remove icon-white'></i></button>
									<ul class='achievement-list'>
										<?php foreach ($workplace as $experience): ?>
										<li index="<?php echo $index; ?>" experience-job-name="<?php echo $experience['Job']['name']; ?>" experience-job-id="<?php echo $experience['Job']['id']; ?>" experience-start="<?php echo $experience['start_date_edit']; ?>" experience-end="<?php echo $experience['final_date_edit']; ?>" experience-report="<?php echo $experience['report']; ?>" experience-team="<?php echo $experience['team']; ?>" editing="false">
											<strong class='experience-period'><?php if ($experience['final_date'] && $experience['final_date'] != '') echo $experience['start_date_edit'].' a '.$experience['final_date_edit']; else echo $experience['start_date_edit']; ?></strong>
											<br />
											<strong class='experience-job'><?php echo $experience['Job']['name']; ?></strong>
											<br />
											<span class='experience-report' <?php if ($experience['report'] == '') echo "style='display: none'"; ?>>Reporte: <?php echo $experience['report']; ?></span>
											<br class='experience-report-break' <?php if ($experience['report'] == '') echo "style='display: none'"; ?> />
											<span class='experience-team' <?php if ($experience['team'] == '') echo "style='display: none'"; ?>>Equipe: <?php echo $experience['team']; ?></span>
											<br class='experience-team-break' <?php if ($experience['team'] == '') echo "style='display: none'"; ?> />
											<button type='button' class='btn btn-primary btn-mini experience-edit-btn' onclick='Candidate.editExperience(this)'><i class='icon-edit icon-white'></i>
											</button>
											<button type='button' class='btn btn-danger btn-mini experience-remove-btn' onclick='Candidate.removeExperience(this)'><i class='icon-remove icon-white'></i>
											</button>
										</li>
										<?php $index += 1; ?>
										<?php endforeach; ?>
									</ul>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
				<div id="workplace-group" class="control-group">
					<?php echo $this->Form->label(null, 'Local de trabalho: ', array('div' => false, 'class' => 'control-label')); ?>
					<div class="controls">
						<div class="input-append">
							<?php echo $this->Html->tag('span', '', array('id' => 'workplace-input', 'class' => 'input-xxlarge uneditable-input')); 
								  echo $this->Html->tag('span', '', array('id' => 'workplace-id-input', 'style' => 'display: none')); 
								  echo $this->Html->tag('span', '', array('id' => 'workplace-nationality-input', 'style' => 'display: none')); 
								  echo $this->Html->tag('span', '', array('id' => 'workplace-market-sector-input', 'style' => 'display: none')); ?>
							<button class="btn" type="button" data-toggle="modal" data-target="#workplace-modal"><i class="icon-search"></i></button>
						</div>
					</div>
				</div>
				<div id="job-group" class="control-group">
					<?php echo $this->Form->label(null, 'Cargo: ', array('div' => false, 'class' => 'control-label')); ?>
					<div class="controls">
						<div class="input-append">
							<?php echo $this->Html->tag('span', '', array('id' => 'job-name-input', 'class' => 'input-xlarge uneditable-input'));
								  echo $this->Html->tag('input', null, array('id' => 'job-input', 'type' => 'hidden', 'value' => '')); ?>
							<button class="btn" type="button" data-toggle="modal" data-target="#job-modal"><i class="icon-search"></i></button>
						</div>
					</div>
				</div>
				<div id="period-group" class="control-group">
					<?php echo $this->Form->label(null, 'Início: ', array('div' => false, 'class' => 'control-label')); ?>
					<div class="controls">
						<?php echo $this->Form->input(null, array('id' => 'experience-start-input', 'type' => 'text', 'placeholder' => 'MM/aaaa', 'div' => false, 'label' => false, 'name' => false, 'value' => '')); ?>
					</div>
					<div class="control-group-internal-divider"></div>
					<?php echo $this->Form->label(null, 'Final: ', array('div' => false, 'class' => 'control-label')); ?>
					<div class="controls">
						<?php echo $this->Form->input(null, array('id' => 'experience-end-input', 'type' => 'text', 'placeholder' => 'MM/aaaa', 'div' => false, 'label' => false, 'name' => false, 'value' => '')); ?>
					</div>
				</div>
				<div id="details-group" class="control-group">
					<?php echo $this->Form->label(null, 'Reporte: ', array('div' => false, 'class' => 'control-label')); ?>
					<div class="controls">
						<?php echo $this->Form->input(null, array('id' => 'experience-report-input', 'type' => 'text', 'div' => false, 'label' => false, 'name' => false, 'value' => '')); ?>
					</div>
					<div class="control-group-internal-divider"></div>
					<?php echo $this->Form->label(null, 'Equipe: ', array('div' => false, 'class' => 'control-label')); ?>
					<div class="controls">
						<?php echo $this->Form->input(null, array('id' => 'experience-team-input', 'type' => 'text', 'div' => false, 'label' => false, 'name' => false, 'value' => '')); ?>
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
						<button id="add-experience-btn" class="btn btn-primary" type='button' onclick='Candidate.addExperience()'><i class="icon-plus icon-white"></i> Adicionar experiência profissional</button>
						<button type='button' id="workplace-edit-btn" class="btn btn-primary" style="display: none" onclick="Candidate.updateWorkplace()"><i class="icon-edit icon-white"></i> Atualizar local de trabalho</button>
						<button type='button' id="experience-edit-btn" class="btn btn-primary" style="display: none" onclick="Candidate.updateExperience()"><i class="icon-edit icon-white"></i> Atualizar realização</button>
						<button type='button' id="workplace-cancel-btn" class="btn" style="display: none" onclick='Candidate.cancelWorkplaceEdit()'>Cancelar</button>
						<button type='button' id="experience-cancel-btn" onclick="Candidate.cancelExperienceEdit()" class="btn" style="display: none">Cancelar</button>
					</div>
				</div>
				<div id='experience-inputs' style='display: none'>
					<?php $index = 0; ?>
					<?php foreach ($this->request->data['Experience'] as $workplace_id => $workplace): ?>
						<?php foreach ($workplace as $experience): ?>
							<input class='form-workplace' name='data[Experience][<?php echo $index; ?>][workplace_id]' type='hidden' value='<?php echo $workplace_id; ?>' workplace-id='<?php echo $workplace_id; ?>' index='<?php echo $index; ?>' />
							<input class='form-job' name='data[Experience][<?php echo $index; ?>][job_id]' type='hidden' value='<?php echo $experience["Job"]["id"]; ?>' workplace-id='<?php echo $workplace_id; ?>' index='<?php echo $index; ?>' />
							<input class='form-start' name='data[Experience][<?php echo $index; ?>][start_date]' type='hidden' value='<?php echo $experience["start_date_edit"]; ?>' workplace-id='<?php echo $workplace_id; ?>' index='<?php echo $index; ?>' />
							<input class='form-end' name='data[Experience][<?php echo $index; ?>][final_date]' type='hidden' value='<?php echo $experience["final_date_edit"]; ?>' workplace-id='<?php echo $workplace_id; ?>' index='<?php echo $index; ?>' />
							<input class='form-report' name='data[Experience][<?php echo $index; ?>][report]' type='hidden' value='<?php echo $experience["report"]; ?>' workplace-id='<?php echo $workplace_id; ?>' index='<?php echo $index; ?>' />
							<input class='form-team' name='data[Experience][<?php echo $index; ?>][team]' type='hidden' value='<?php echo $experience["team"]; ?>' workplace-id='<?php echo $workplace_id; ?>' index='<?php echo $index; ?>' />
							<?php $index += 1; ?>
						<?php endforeach; ?>
					<?php endforeach; ?>
				</div>
			</fieldset>
			
			<fieldset>
				<legend>Currículo</legend>
				<div class='control-group'>
					<?php if (isset($this->request->data['Curriculum']['name'])): ?>
					<label class='control-label'>Currículo existente: </label>
					<div class='controls'>
						<?php echo $this->Html->image('pdficon_large.png');
				  			  echo $this->Html->link($this->request->data['Curriculum']['name'], array('action' => 'curriculum', $this->request->data['Candidate']['id']), array('style' => 'margin-left: 10px')); ?>
					</div>
					<div class='control-group-internal-divider'></div>
					<label class='control-label'>Atualizar currículo: </label>
					<?php else: ?>
					<label class='control-label'>Adicionar currículo: </label>
					<?php endif; ?>
					<div class='controls'>
						<input name='data[Curriculum]' type='file' />
					</div>
				</div>
			</fieldset>

			<div class="form-actions" style="padding-left: 20px">
				<?php echo $this->Form->submit('Atualizar', array('class' => 'btn btn-primary', 'div' => false));
					  echo $this->Html->link('Voltar', array('action' => 'index'), array('class' => 'btn', 'style' => 'margin-left: 10px')); ?>
			</div>

		<?php echo $this->Form->end(); ?>
	</div>

</div>

<div id="formation-modal" class="modal hide fade" tabindex="-1" role="dialog" data-backdrop="static">
  	<div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    	<h3>Tipo de Formação</h3>
    	<?php echo $this->Form->create('FormationSearch', array('class' => 'form-search', 'style' => 'margin: 10px 0 0 0', 'onsubmit' => 'return Candidate.searchFormation(this)'));
    		  echo $this->Form->input(null, array('div' => false, 'label' => false, 'type' => 'text', 'class' => 'input-medium search-query', 'style' => 'width: 415px'));
    		  echo $this->Form->button('Buscar', array('div' => false, 'class' => 'btn', 'style' => 'margin-left: 5px'));
		      echo $this->Form->end(); ?>
  	</div>
  	<div class="modal-body" id='formation-content'>
  		<?php $modal_data = $formations;
			  $modal_table = 'formation';
			  include '_modal_content.ctp'; ?>
  	</div>
  	<div class="modal-footer">
  		<form class="form-horizontal">
  			<div class="control-group">
  				<label class="control-label" style="width: auto; margin-right: 15px; margin-left: 5px">Nova formação</label>
  				<div class="controls" style="text-align: left; margin-left: 0">
  					<input id="formation-new-input" type="text" class="span5" style="width: 397px" />
  				</div>
  			</div>
  		</form>
  		<button type='button' class="btn btn-primary" onclick='Candidate.addFormation()'>Adicionar formação</button>
    	<button class="btn" data-dismiss="modal" aria-hidden="true">Fechar</button>
  	</div>
</div>

<div id="course-modal" class="modal hide fade" tabindex="-1" role="dialog" data-backdrop="static">
  	<div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    	<h3>Curso / Especialização</h3>
    	<?php echo $this->Form->create('CourseSearch', array('class' => 'form-search', 'style' => 'margin: 10px 0 0 0', 'onsubmit' => 'return Candidate.searchCourse(this)'));
    		  echo $this->Form->input(null, array('div' => false, 'label' => false, 'type' => 'text', 'class' => 'input-medium search-query', 'style' => 'width: 415px'));
    		  echo $this->Form->button('Buscar', array('div' => false, 'class' => 'btn', 'style' => 'margin-left: 5px'));
		      echo $this->Form->end(); ?>
  	</div>
  	<div class="modal-body" id='course-content'>
  		<?php $modal_data = $courses;
			  $modal_table = 'course';
			  include '_modal_content.ctp'; ?>
  	</div>
  	<div class="modal-footer">
  		<form class="form-horizontal">
  			<div class="control-group">
  				<label class="control-label" style="width: auto; margin-right: 15px; margin-left: 5px">Adicionar novo:</label>
  				<div class="controls" style="text-align: left; margin-left: 0">
  					<input id="course-new-input" type="text" class="span5" style="width: 397px" />
  				</div>
  			</div>
  		</form>
  		<button type='button' class="btn btn-primary" onclick='Candidate.addCourse()'>Adicionar curso / especialização</button>
    	<button class="btn" data-dismiss="modal" aria-hidden="true">Fechar</button>
  	</div>
</div>

<div id="workplace-modal" class="modal hide fade" tabindex="-1" role="dialog" data-backdrop="static">
  	<div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    	<h3>Local de trabalho</h3>
    	<?php echo $this->Form->create('WorkplaceSearch', array('class' => 'form-search', 'style' => 'margin: 10px 0 0 0', 'onsubmit' => 'return Candidate.searchWorkplace(this)'));
    		  echo $this->Form->input(null, array('div' => false, 'label' => false, 'type' => 'text', 'class' => 'input-medium search-query', 'style' => 'width: 415px'));
    		  echo $this->Form->button('Buscar', array('div' => false, 'class' => 'btn', 'style' => 'margin-left: 5px'));
		      echo $this->Form->end(); ?>
  	</div>
  	<div id='workplace-content' class="modal-body" style="max-height: 300px">
		<?php include '_modal_workplace.ctp'; ?>
  	</div>
  	<div class="modal-footer">
  		<form>
  			<div style="float: left">
				<label style="line-height: 30px; float: left; margin-right: 49px">Empresa</label>
				<input id="workplace-name-new-input" type="text" style="float: left"/>
			</div>
			<div style="float: left">
				<label style="line-height: 30px; float: left; margin-right: 41px">Segmento</label>
				<?php echo $this->Form->input(null, array('div' => false, 'label' => false, 'options' => $market_sectors, 'class' => 'pull-left', 'id' => 'workplace-market-sector-new-input', 'empty' => 'Selecione...', 'onchange' => 'Candidate.selectWorkplaceMarketSector(this)')); ?>
				<div class="input-append" style="float: left; display: none" id="workplace-market-sector-add-input">
					<input type="text" />
					<span onclick="Candidate.cancelWorkplaceMarketSectorAdd()" class="add-on" style="cursor: pointer">X</span>
				</div>
			</div>
			<div style="float: left">
				<label style="line-height: 30px; float: left; margin-right: 15px">Nacionalidade</label>
				<input id="workplace-nationality-new-input" type="text" style="float: left"/>
			</div>
  		</form>
  		
    	<a id="add-new-work-local" class="btn btn-primary" style="float:left; margin-left: 25px" onclick="Candidate.addWorkplace()"><i class="icon-plus icon-white"></i> Adicionar novo local</a>
  	</div>
</div>

<div id="job-modal" class="modal hide fade" tabindex="-1" role="dialog" data-backdrop="static">
  	<div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    	<h3>Cargo</h3>
    	<?php echo $this->Form->create('JobSearch', array('class' => 'form-search', 'style' => 'margin: 10px 0 0 0', 'onsubmit' => 'return Candidate.searchJob(this)'));
    		  echo $this->Form->input(null, array('div' => false, 'label' => false, 'type' => 'text', 'class' => 'input-medium search-query', 'style' => 'width: 415px'));
    		  echo $this->Form->button('Buscar', array('div' => false, 'class' => 'btn', 'style' => 'margin-left: 5px'));
		      echo $this->Form->end(); ?>
  	</div>
  	<div class="modal-body" id='job-content'>
  		<?php $modal_data = $jobs;
			  $modal_table = 'job';
			  include '_modal_content.ctp'; ?>
  	</div>
  	<div class="modal-footer">
  		<form class="form-horizontal">
  			<div class="control-group">
  				<label class="control-label" style="width: auto; margin-right: 15px; margin-left: 5px">Novo cargo</label>
  				<div class="controls" style="text-align: left; margin-left: 0">
  					<input id="job-new-input" type="text" class="span5" style="width: 397px" />
  				</div>
  			</div>
  		</form>
  		<button type='button' class="btn btn-primary" onclick='Candidate.addJob()'>Adicionar cargo</button>
    	<button class="btn" data-dismiss="modal" aria-hidden="true">Fechar</button>
  	</div>
</div>