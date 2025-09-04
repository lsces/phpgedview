<?php
/**
 * Portugese Language file for PhpGedView.
 *
 * phpGedView: Genealogy Viewer
 * Copyright (C) 2002 to 2011  PGV Development Team.  All rights reserved.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *
 * @package PhpGedView
 * @author José Monteiro
 * @website http://existologoescrevo.blogspot.com/
 * @e-mail jalberto@bluewin.ch
 * @version $Id$
 */

namespace Bitweaver\Phpgedview;
$pgv_lang["analytics_config"]       = "Web Analytics";
$pgv_lang["google_analytics"]       = "Google Analytics";
$pgv_lang["USE_GOOGLE_ANALYTICS"]   = "Ativar Google Analytics?";
$pgv_lang["PGV_GOOGLE_ANALYTICS"]   = "Número da conta Google Analytics";
$pgv_lang["piwik_analytics"]        = "Piwik Analytics";
$pgv_lang["USE_PIWIK_ANALYTICS"]    = "Ativar Piwik Analytics?";
$pgv_lang["PGV_PIWIK_URL"]          = "URL do servidor de Piwik Analytics";
$pgv_lang["PGV_PIWIK_SITE"]         = "Número site";
$pgv_lang["clustrmaps_analytics"]   = "ClustrMaps Analytics";
$pgv_lang["USE_CLUSTRMAPS_ANALYTICS"] = "Ativar ClustrMaps Analytics?";
$pgv_lang["PGV_CLUSTRMAPS_SITE"]    = "URL PhpGedView";
$pgv_lang["PGV_CLUSTRMAPS_SERVER"]  = "Número do servidor ClustrMaps";

$pgv_lang["module_admin"]			= "Administração dos Módulos";
$pgv_lang["mod_admin_installed"]	= "Módulos instalados";
$pgv_lang["mod_admin_tabs"]			= "Gerenciar Guias";
$pgv_lang["mod_admin_menus"]		= "Gerenciar Menus";
$pgv_lang["mod_admin_intro"]		= "Abaixo está a lista de todos os módulos instalados neste caso de PhpGedView.  Os módulos são instalados por colocá-los em <i>modules</i> diretório.  Aqui você pode definir o nível de acesso para cada GEDCOM para cada módulo.  Se um módulo inclui guias para a página individual ou menus da barra de menu, você também pode definir o nível de acesso e a ordem de cada uma delas.";
$pgv_lang["mod_admin_active"]		= "Ativo";
$pgv_lang["mod_admin_name"]			= "Nome do módulo";
$pgv_lang["mod_admin_description"]	= "Descrição";
$pgv_lang["mod_admin_version"]		= "Versão / PGV";
$pgv_lang["mod_admin_hastab"]		= "Guia?";
$pgv_lang["mod_admin_hasmenu"]		= "Menu?";
$pgv_lang["mod_admin_access_level"]	= "Nível de Acesso";
$pgv_lang["mod_admin_order"]		= "Ordem";
$pgv_lang["mod_admin_config"]		= "Configurações dos Módulos";
$pgv_lang["mod_admin_settings"]		= "Configurações dos Módulos";
$pgv_lang["ret_module_admin"]		= "Voltar à página de administração de módulos";
$pgv_lang["ret_admin"]				= "Voltar à página de administração";

$pgv_lang["enter_comment"]	= "Você pode inserir um comentário aqui.";
$pgv_lang["upload_a_gedcom"] 		= "Carregar um ficheiro GEDCOM";
$pgv_lang["start_entering"] 		= "Iniciar a introdução de dados";
$pgv_lang["add_gedcom_from_path"] 	= "Adicionar um GEDCOM de um local de ficheiro";
$pgv_lang["get_started_instructions"]	= "Escolha uma das opções para começar a usar PhpGedView";

$pgv_lang["admin_users_exists"]		= "Os seguintes membros administrativos já existentes:";
$pgv_lang["install_step_1"] = "Verifique ambiente";
$pgv_lang["install_step_2"] = "Conexão de banco de dados";
$pgv_lang["install_step_3"] = "Criar tabelas";
$pgv_lang["install_step_4"] = "Configuração do site";
$pgv_lang["install_step_5"] = "Línguas";
$pgv_lang["install_step_6"] = "Salvar configuração";
$pgv_lang["install_step_7"] = "Criar membro administrativo";
$pgv_lang["install_wizard"] = "Assistente de instalação";
$pgv_lang["basic_site_config"] = "Configurações básicas";
$pgv_lang["adv_site_config"] = "Configurações avançadas";
$pgv_lang["config_not_saved"] = "*As suas configurações não<br />serão salvas até a etapa 6";
$pgv_lang["download_config"] = "Download config.php";
$pgv_lang["site_unavailable"] = "Este site está indisponível";
$pgv_lang["to_manage_users"] = "Para gerenciar membros, utilize a página de <a href=\"useradmin.php\">administração de membros</a>.";
$pgv_lang["db_tables_created"] = "Tabelas de banco de dados criado com sucesso";
$pgv_lang["config_saved"] = "A configuração foi salva com sucesso";
$pgv_lang["checking_errors"]		= "Verificando erros...";
$pgv_lang["checking_php_version"]		= "Verificando necessária versão do PHP:";
$pgv_lang["failed"]		= "Falha";
$pgv_lang["pgv_requires_version"]		= "PhpGedView requer a versão #PGV_REQUIRED_PHP_VERSION# do PHP ou superior.";
$pgv_lang["using_php_version"]		= "Você está usando a versão #PGV_ACTUAL_PHP_VERSION# do PHP";
$pgv_lang["checking_db_support"]		= "Verificação de suporte de banco de dados mínimo:";
$pgv_lang["no_db_extensions"]		= "Você não tem qualquer uma das extensões de banco de dados suportados.";
$pgv_lang["db_ext_support"]		= "Você tem apoio #DBEXT#";
$pgv_lang["checking_config.php"]		= "Verificando ficheiro config.php:";
$pgv_lang["config.php_missing"]		= "Ficheiro config.php não foi encontrado.";
$pgv_lang["config.php_missing_instr"]		= "Este assistente de instalação não será capaz de gravar as configurações para o ficheiro config.php.  Você pode fazer uma cópia do ficheiro config.dist e renomeie para config.php.  Como alternativa, depois de concluir este assistente, você terá a opção de descarregar as configurações e fazer o envio do ficheiro config.php resultante.";
$pgv_lang["config.php_not_writable"]		= "O ficheiro config.php não é gravável.";
$pgv_lang["config.php_not_writable_instr"]		= "Este assistente de instalação não será capaz de gravar as configurações para o ficheiro config.php.  Você pode configurar permissões de gravação no ficheiro, ou depois de concluir este assistente, você terá a opção de baixar as configurações e fazer o envio do ficheiro config.php resultante.";
$pgv_lang["passed"]		= "Passado";
$pgv_lang["config.php_writable"]		= "O ficheiro config.php está presente e gravável.";
$pgv_lang["checking_warnings"]		= "Verificação da existência de avisos...";
$pgv_lang["checking_timelimit"]		= "Verificando a capacidade de alterar o limite de tempo:";
$pgv_lang["cannot_change_timelimit"]		= "Não é possível alterar o limite de tempo.";
$pgv_lang["cannot_change_timelimit_instr"]		= "Você pode não ser capaz de executar todas as funções em grandes bases de dados com muitos indivíduos.";
$pgv_lang["current_max_timelimit"]		= "Seu prazo máximo é de";
$pgv_lang["check_memlimit"]		= "Verificando a capacidade de alterar o limite de memória:";
$pgv_lang["cannot_change_memlimit"]		= "Não é possível alterar o limite de memória.";
$pgv_lang["cannot_change_memlimit_instr"]		= "Você pode não ser capaz de executar todas as funções em grandes bases de dados com muitos indivíduos.";
$pgv_lang["current_max_memlimit"]		= "Seu limite de memória atual é de";
$pgv_lang["check_upload"]		= "Verificação da capacidade de envio de Ficheiros:";
$pgv_lang["current_max_upload"]		= "Seu tamanho máximo de envio do ficheiro é de";
$pgv_lang["check_gd"]		= "Verificando a biblioteca de funções da GD:";
$pgv_lang["cannot_use_gd"]		= "Você não tem a biblioteca de funções da GD.  Você não será capaz de criar automaticamente miniaturas das imagens.";
$pgv_lang["check_sax"]		= "Verificando a biblioteca de funções para analisar XML:";
$pgv_lang["cannot_use_sax"]		= "Você não tem a biblioteca de funções para analisar XML.  Você não será capaz de executar quaisquer relatórios ou algumas outras funções auxiliares.";
$pgv_lang["check_dom"]		= "Verificando a biblioteca de funções para manipular de XML:";
$pgv_lang["cannot_use_dom"]		= "Você não tem a biblioteca de funções para manipular de XML.  Você não será capaz de exportação XML.";
$pgv_lang["check_calendar"]		= "Verificando a biblioteca de funções do calendário:";
$pgv_lang["cannot_use_calendar"]		= "Você não tem a biblioteca de funções do calendário.  Você não será capaz de executar algumas funções de calendário avançado.";
$pgv_lang["warnings_passed"]		= "Todas as pesquisas de alertas passados.";
$pgv_lang["warning_instr"]		= "Se qualquer das advertências não passam ainda pode ser capaz de executar PhpGedView neste servidor, mas alguma funcionalidade pode ser desativada ou você pode enfrentar um desempenho ruim.";

$pgv_lang["associated_files"]		= "Ficheiros associados:";
$pgv_lang["remove_all_files"]		= "Remova todos os Ficheiros não-essenciais";
$pgv_lang["warn_file_delete"]		= "Este ficheiro contém informações importantes, tais como configurações de idioma ou alterações pendentes. Tem certeza de que deseja excluir este ficheiro?";
$pgv_lang["deleted_files"]          = "Ficheiros apagados:";
$pgv_lang["index_dir_cleanup_inst"]	= "Para excluir um ficheiro ou subdiretório do diretório <i>index</i> arrastá-lo para a lixeira ou selecione-o.  Clique no botão Excluir para remover permanentemente os Ficheiros indicados.<br /><br />Os Ficheiros marcados com <img src=\"./images/RESN_confidential.gif\" alt=\"\" /> são necessários para o funcionamento correto e não pode ser removido.<br />Os Ficheiros marcados com <img src=\"./images/RESN_locked.gif\" alt=\"\" /> ter definições importantes ou alterações pendentes e só deve ser excluído se tiver certeza de que sabe o que está fazendo.<br /><br />";
$pgv_lang["index_dir_cleanup"]		= "Limpeza diretório <i>index</i>";
$pgv_lang["clear_cache_succes"]		= "Os Ficheiros de cache foram removidos.";
$pgv_lang["clear_cache"]			= "Remover Ficheiros de cache";
$pgv_lang["sanity_err0"]			= "Erros:";
$pgv_lang["sanity_err1"]			= "Precisas de ter o PHP versão #PGV_REQUIRED_PHP_VERSION# ou superior.";
$pgv_lang["sanity_err2"]			= "O ficheiro ou diretório <i>#GLOBALS[whichFile]#</i> não existe. Verifique se o ficheiro ou diretório existe, não foi mal-chamada, e as permissões de leitura são definidas corretamente.";
$pgv_lang["sanity_err3"]			= "O ficheiro <i>#GLOBALS[whichFile]#</i> não carregar corretamente. Por favor, tente fazer o envio do ficheiro novamente.";
$pgv_lang["sanity_err4"]			= "O ficheiro <i>config.php</i> está corrompido.";
$pgv_lang["sanity_err5"]			= "O ficheiro <i>config.php</i> não é gravável.";
$pgv_lang["sanity_err6"]			= "O diretório <i>#GLOBALS[INDEX_DIRECTORY]#</i> não é gravável.";
$pgv_lang["sanity_warn0"]			= "Avisos:";
$pgv_lang["sanity_warn1"]			= "O diretório <i>#GLOBALS[MEDIA_DIRECTORY]#</i> não é gravável.  Você não será capaz de carregar Ficheiros de mídia ou gerar miniaturas no PhpGedView.";
$pgv_lang["sanity_warn2"]			= "O diretório <i>#GLOBALS[MEDIA_DIRECTORY]#thumbs</i> não é gravável.  Você não será capaz de carregar Ficheiros de miniaturas ou gerar miniaturas no PhpGedView.";
$pgv_lang["sanity_warn3"]			= "A biblioteca de funções da GD não existe. PhpGedView continuará a funcionar, mas algumas das características, tais como a geração de miniaturas eo diagrama de círculo, não funciona sem a biblioteca de funções da GD. Consulte <a href='http://www.php.net/manual/pt_BR/ref.image.php'>http://www.php.net/manual/pt_BR/ref.image.php</a> para obter mais informações.";
$pgv_lang["sanity_warn4"]			= "A biblioteca de funções para analisar XML não existe. PhpGedView continuará a funcionar, mas algumas das características, tais como geração de relatórios e serviços web, não funciona sem a biblioteca de funções para analisar XML. Consulte <a href='http://www.php.net/manual/pt_BR/ref.xml.php'>http://www.php.net/manual/pt_BR/ref.xml.php</a> para obter mais informações.";
$pgv_lang["sanity_warn5"]			= "A biblioteca de funções para manipular de XML não existe. PhpGedView continuará a funcionar, mas algumas das características, tais como características Gramps exportação no carrinho de recortes de download, e serviços de web, não vai funcionar. Consulte <a href='http://www.php.net/manual/pt_BR/refs.xml.php'>http://www.php.net/manual/pt_BR/refs.xml.php</a> para obter mais informações.";
$pgv_lang["sanity_warn6"]			= "A biblioteca de funções do calendário não existe. PhpGedView continuará a funcionar, mas algumas das características, tais como a conversão de outros calendários, como o hebraico e francês, não vai funcionar. Não é essencial para a execução de PhpGedView. Consulte <a href='http://www.php.net/manual/pt_BR/ref.calendar.php'>http://www.php.net/manual/pt_BR/ref.calendar.php</a> para obter mais informações.";
$pgv_lang["ip_address"]				= "Endereço IP";
$pgv_lang["date_time"]				= "Data e hora";
$pgv_lang["log_message"]			= "Mensagem no log";
$pgv_lang["searchtype"]				= "Tipo de pesquisa";
$pgv_lang["query"]					= "Questão";
$pgv_lang["user"]="Membro Autenticado";
$pgv_lang["editors"]				= "Editores";
$pgv_lang["gedcom_admins"]			= "Administradores de GEDCOM";
$pgv_lang["site_admins"]			= "Administradores do site";
$pgv_lang["nobody"]					= "Ninguém";
$pgv_lang["thumbnail_deleted"]="Miniatura excluída com sucesso.";
$pgv_lang["thumbnail_not_deleted"]="Não foi possível excluir a Miniatura.";
$pgv_lang["step2"]="Passo 2 de 4:";
$pgv_lang["refresh"]="Atualizar";
$pgv_lang["move_file_success"]="Mídia e Miniatura movidas com sucesso.";
$pgv_lang["media_folder_corrupt"]="A pasta de Mídias está corrompida.";
$pgv_lang["media_file_not_deleted"]="Não foi possível excluir ficheiro de Mídia.";
$pgv_lang["gedcom_deleted"]="GEDCOM [#GED#] excluido com sucesso.";
$pgv_lang["gedadmin"]="Administrador de GEDCOM";
$pgv_lang["full_name"]="Nome Completo";
$pgv_lang["error_header"]="O ficheiro GEDCOM, [#GEDCOM#], não existe no local informado.";
$pgv_lang["confirm_delete_file"]="Confirma exclusão do ficheiro?";
$pgv_lang["confirm_folder_delete"]="Confirma exclusão desta pasta?";
$pgv_lang["confirm_remove_links"]="Confirma a exclusão de todas as ligações deste objeto?";
$pgv_lang["PRIV_PUBLIC"]			= "Mostrar ao público";
$pgv_lang["PRIV_USER"]				= "Mostrar só para membros autenticados";
$pgv_lang["PRIV_NONE"]				= "Mostrar apenas para os membros administradores";
$pgv_lang["PRIV_HIDE"]				= "Ocultar mesmo de membros administradores";
$pgv_lang["manage_gedcoms"]="Gerenciar GEDCOM e editar Privacidade";
$pgv_lang["keep_media"]				= "Manter conexões de mídia";
$pgv_lang["current_links"]			= "Conexões";
$pgv_lang["add_more_links"]			= "Adicione conexões";
$pgv_lang["enter_pid_or_name"]		= "Digite o ID ou o nome de cada um";
$pgv_lang["set_links"]				= "Definir conexões";
$pgv_lang["add_or_remove_links"]	= "Gerenciar conexões";

$pgv_lang["keep"]					= "Manter";
$pgv_lang["unlink"]					= "Desligar";
$pgv_lang["nav"]					= "Navegador";
$pgv_lang["fam_nav"]				= "Navegador da família";
$pgv_lang["remove"]					= "Remover";
$pgv_lang["keep_link"]				= "Mantenha a conexão na lista";
$pgv_lang["remove_link"]			= "Remover a conexão da lista";
$pgv_lang["open_nav"]				= "Abrir navegador da família";
$pgv_lang["link_exists"]			= "Essa conexão já existe";
$pgv_lang["id_not_valid"]			= "Não é válido individual, familiar ou ID de origem";
$pgv_lang["add_fam_other_links"]	= "Adicionar Família e busca as conexões Search";
$pgv_lang["search_add_links"]		= "Procurar pessoas para adicionar à lista Adicionar conexões";
$pgv_lang["enter_name"]				= "Digite um nome";
$pgv_lang["add_indi_to_link_list"]	= "Clique no nome para adicionar pessoas para adicionar à lista Adicionar conexões.";
$pgv_lang["click_choose_head"]		= "Clique #GLOBALS[tempStringHead]# para escolher pessoa como chefe de família.";
$pgv_lang["click_choose_head_text"]	= "Clique para escolher a pessoa como chefe de família..";
$pgv_lang["head"]					= "Chefe";
$pgv_lang["id_empty"]				= "Ao adicionar uma conexão, o campo ID não pode ser vazia.";
$pgv_lang["link_deleted"]			= "Conexão para #GLOBALS[remLinkId]# excluído";
$pgv_lang["link_added"]				= "Conexão para xx adicionou";
$pgv_lang["no_update_CHANs"]		= "Não atualize o registos CHAN (última alteração)";
$pgv_lang["no_CHANs_update"]		= "Não registos CHAN (última alteração) foram atualizados";

$pgv_lang["files_in_backup"]		= "Ficheiros incluídos no backup";
$pgv_lang["created_remotelinks"]="Tabela de <i>Ligações Externas</i> criada com sucesso.";
$pgv_lang["created_remotelinks_fail"]="Não foi possível criar a tabela de <i>Ligações Externas</i>.";
$pgv_lang["created_indis"]="Criada com sucesso tabela de <i>Pessoas</i>.";
$pgv_lang["created_indis_fail"]="Incapaz de criar tabela de <i>Pessoas</i>.";
$pgv_lang["created_fams"]="Criada com sucesso tabela de <i>Famílias</i>.";
$pgv_lang["created_fams_fail"]="Incapaz de criar tabela de <i>Famílias</i>.";
$pgv_lang["created_sources"]="Criada com sucesso tabela de <i>Fontes</i>.";
$pgv_lang["created_sources_fail"]="Incapaz de criar tabela de <i>Fontes</i>.";
$pgv_lang["created_other"]="Criada com sucesso <i>Outras</i> tabelas.";
$pgv_lang["created_other_fail"]="Incapaz de criar <i>Outras</i> tabelas.";
$pgv_lang["created_places"]="Criada com sucesso tabela de <i>Locais</i>.";
$pgv_lang["created_places_fail"]="Incapaz de criar tabela de <i>Locais</i>.";
$pgv_lang["created_placelinks"]="Tabela de <i>Ligações de Locais</i> criada com sucesso.";
$pgv_lang["created_placelinks_fail"]="Não foi possível criar a tabela de <i>Ligações para Locais</i>.";
$pgv_lang["created_media_fail"]="Não foi possível criar a tabela de <i>Mídia</i>.";
$pgv_lang["created_media_mapping_fail"]="Não foi possível criar a tabela de <i>Mapeamento de Mídia</i>.";
$pgv_lang["no_thumb_dir"]="Pasta de Miniaturas não existe e não foi possível cria-la.";
$pgv_lang["folder_created"]="Pasta criada";
$pgv_lang["folder_no_create"]="Não foi possível criar a pasta";
$pgv_lang["security_no_create"]="Aviso: Não foi possível criar o ficheiro <b><i>index.php</i></b> em ";
$pgv_lang["security_not_exist"]="Aviso: O ficheiro <b><i>index.php</i></b> não existe em ";
$pgv_lang["label_delete"]="Excluir";
$pgv_lang["progress_bars_info"]			= "As barras de status abaixo vou deixar você saber como a importação está progredindo. Se o limite de tempo se esgote a importação será interrompido e você terá que pressionar um botão <b>Continuar</b>. Se você não vê o botão <b>Continuar</b>, você deve reiniciar a importação com um valor menor limite de tempo.";
$pgv_lang["upload_replacement"]			= "Carregar uma substituição";
$pgv_lang["about_user"]="Primeiro crie a conta do Administrador, pois é ele que tem privilégios para alterar os Ficheiros de configuração, ver dados privados e criar outros membros.";
$pgv_lang["access"]="Aceder";
$pgv_lang["add_gedcom"]="Incluir ficheiro GEDCOM";
$pgv_lang["add_new_gedcom"]="Criar um novo ficheiro GEDCOM";
$pgv_lang["add_new_language"]			= "Adicione os Ficheiros e configurações para um novo idioma";
$pgv_lang["add_user"]="Adicionar um novo Membro";
$pgv_lang["admin_gedcom"]="Gerenciar GEDCOM";
$pgv_lang["admin_gedcoms"]="Clique aqui para Administrar os GEDCOMs.";
$pgv_lang["admin_geds"]="Gerenciar GEDCOM e Dados";
$pgv_lang["admin_info"]="Informativo";
$pgv_lang["admin_site"]="Gerenciar Site";
$pgv_lang["admin_user_warnings"]		= "Uma ou mais contas de membros possuem avisos";
$pgv_lang["admin_verification_waiting"]="Existem solicitações de contas pendentes de autorização";
$pgv_lang["administration"]="Administração";
$pgv_lang["ALLOW_CHANGE_GEDCOM"]="Permitir trocar de GEDCOM";
$pgv_lang["ALLOW_USER_THEMES"]="Membros podem selecionar o tema de sua preferência";
$pgv_lang["ansi_encoding_detected"]="Detectado ficheiro com configuração ANSI.  PhpGedView trabalha melhor com Ficheiros configurados em UTF-8.";
$pgv_lang["ansi_to_utf8"]="Converter esse ficheiro GEDCOM do formato ANSI (ISO-8859-1) para UTF-8?";
$pgv_lang["apply_privacy"]="Aplicar medidas de privacidade?";
$pgv_lang["back_useradmin"]				= "Retornar para administração de membros";
$pgv_lang["bytes_read"]="Bytes Lidos";
$pgv_lang["can_admin"]="Pode Administrar";
$pgv_lang["can_edit"]="Nível de Acesso";
$pgv_lang["change_id"]="Alterar ID da Pessoa para";
$pgv_lang["choose_priv"]="Selecione o nível de privacidade:";
$pgv_lang["cleanup_places"]="Limpeza de Locais";
$pgv_lang["cleanup_users"]				= "Limpeza de membros";
$pgv_lang["click_here_to_continue"]="Clique aqui para continuar.";
$pgv_lang["click_here_to_go_to_pedigree_tree"]="Clique aqui para ir para a Árvore Genealógica.";
$pgv_lang["comment"]="Comentários do Administrador sobre o Membro";
$pgv_lang["comment_exp"]="Comentário do administrador";
$pgv_lang["config_help"]="Configuration Help";
$pgv_lang["config_still_writable"]	= "O ficheiro <i>config.php</i> permanece com permissão de escrita. Por segurança, configure a permissão deste ficheiro apenas para leitura após terminar de alterar a configuração de seu site.";
$pgv_lang["configuration"]="Configuração";
$pgv_lang["configure"]="Configurar PhpGedView";
$pgv_lang["configure_head"]="Configuração do PhpGedView";
$pgv_lang["confirm_gedcom_delete"]="Você tem certeza que deseja excluir este GEDCOM";
$pgv_lang["confirm_user_delete"]="Tem certeza que deseja excluir o membro";
$pgv_lang["create_user"]="Criar Membro";
$pgv_lang["current_users"]="Membros Cadastrados";
$pgv_lang["daily"]="Diariamente";
$pgv_lang["dataset_exists"]="Um ficheiro GEDCOM com este nome já foi importado para esse banco de dados.";
$pgv_lang["unsync_warning"] 					= "Este ficheiro GEDCOM é <em>não</em> sincronizado com o banco de dados. Não pode conter a versão mais recente de seus dados. Para voltar a importar do banco de dados em vez do ficheiro, você deve baixar e voltar a carregar.";
$pgv_lang["date_registered"]="Data de Registro";
$pgv_lang["day_before_month"]="Dia antes do Mês (DD MM YYYY)";
$pgv_lang["DEFAULT_GEDCOM"]="Default GEDCOM";
$pgv_lang["default_user"]="Criar a conta de Administrador";
$pgv_lang["del_gedrights"]						= "Este ficheiro GEDCOM não está mais ativo, remover as referências do membro.";
$pgv_lang["del_proceed"]						= "Continuar";
$pgv_lang["del_unvera"]							= "Membro não verificadas pelo administrador.";
$pgv_lang["del_unveru"]							= "Membro não verificar no prazo de 7 dias.";
$pgv_lang["do_not_change"]="Não alterar";
$pgv_lang["download_gedcom"]="Descarregar GEDCOM";
$pgv_lang["download_here"]						= "Clique aqui para baixar o ficheiro.";
$pgv_lang["download_note"]="Observação: O processamento, que é feito antes do download, de GEDCOMs muito grandes pode ser demorado. Caso o PHP encerre o processamento por \"time out\", o ficheiro poderá estar imcompleto.<br /><br />Para saber se o ficheiro está integro, utilize um editor de texto qualquer e verifique se a última linha do ficheiro GEDCOM é um <b>0&nbsp;TRLR</b>. <u>Não</u> salve o ficheiro GEDCOM após verifica-lo.<br /><br />O processo de \"download\" pode demorar tanto quanto para o processo de envio do GEDCOM.";
$pgv_lang["editaccount"]="Permite este membro alterar as informações de sua conta";
$pgv_lang["empty_dataset"]="Você deseja apagar os dados antigos e substituir por estes novos?";
$pgv_lang["empty_lines_detected"]="Detectado linhas vazias em seu ficheiro GEDCOM.  Na 'Limpeza' essas linhas vazias serão removidas.";
$pgv_lang["enable_disable_lang"]				= "Configure os idiomas suportados";
$pgv_lang["error_ban_server"]="Endereço de IP inválido.";
$pgv_lang["error_delete_person"]="Selecione a pessoa, cuja ligação remota, você deseja excluir.";
$pgv_lang["error_header_write"]="O ficheiro GEDCOM, [#GEDCOM#], não tem permissão para escrita. Verifique atributos e direitos de acesso.";
$pgv_lang["error_remove_site"]					= "O servidor remoto não pode ser removido.";
$pgv_lang["error_remove_site_linked"]			= "O servidor remoto não pôde ser removido porque sua lista de conexões não está vazio.";
$pgv_lang["error_remote_duplicate"]				= "Este banco de dados remoto já está na lista como <i>#GLOBALS[whichFile]#</i>";
$pgv_lang["error_siteauth_failed"]="Falhou a autenticação com o site remoto";
$pgv_lang["error_url_blank"]="Favor preencher o título e o endereço do site";
$pgv_lang["error_view_info"]="Selecione uma pessoa para ver as informações dela.";
$pgv_lang["example_date"]="Exemplo de data inválida do seu GEDCOM:";
$pgv_lang["example_place"]="Exemplo de um lugar inválido de sua GEDCOM:";
$pgv_lang["fbsql"]="FrontBase";
$pgv_lang["found_record"]="Registro encontrado";
$pgv_lang["ged_download"]="Descarregar";
$pgv_lang["ged_import"]="Importar";
$pgv_lang["ged_export"]							= "Exportar";
$pgv_lang["ged_check"]							= "Verificar";
$pgv_lang["gedcom_adm_head"]="Gerenciar GEDCOM";
$pgv_lang["gedcom_config_write_error"]			= "E R R O !!!<br />Não foi possível escrever no ficheiro <i>#GLOBALS[whichFile]#</i>. Por favor, verifique se está adequada permissões de gravação.";
$pgv_lang["gedcom_downloadable"]="Este ficheiro GEDCOM pode ser copiado pela Internet!<br />Leia a seção de Segurança no ficheiro <a href=\"readme.txt\"><b>readme.txt</b></a> e saiba como corrigir o problema.";
$pgv_lang["gedcom_file"]="Ficheiro GEDCOM:";
$pgv_lang["gedcom_not_imported"]				= "Este ficheiro GEDCOM ainda não foi importado.";
$pgv_lang["ibase"]="InterBase";
$pgv_lang["ifx"]="Informix";
$pgv_lang["img_admin_settings"]="Configuração de Edit Image Manipulation";
$pgv_lang["autoContinue"]						= "Automaticamente pressione o botão «Continuar»";
$pgv_lang["import_complete"]="Importação terminada.";
$pgv_lang["import_options"]="Opções de Importação";
$pgv_lang["import_progress"]="Importação em progresso, Aguarde ...";
$pgv_lang["import_statistics"]="Estatística da Importação";
$pgv_lang["import_time_exceeded"]="Tempo máximo de processamento para a importação dos dados foi excedido. Para prosseguir com a importação do GEDCOM é necessário clicar no botão Continuar.";
$pgv_lang["inc_languages"]="Idiomas";
$pgv_lang["INDEX_DIRECTORY"]="Pasta do ficheiro de Índice";
$pgv_lang["invalid_dates"]="Detectado formato inválido de datas, na 'Limpeza' esses dados serão modificados para o formato DD MMM YYYY (ex. 1 JAN 2004).";
$pgv_lang["BOM_detected"]						= "Um Byte Order Mark (BOM) foi detectado no início do ficheiro. Na limpeza, este código especial será removido.";
$pgv_lang["invalid_header"]="Detectado linhas antes do cabeçalho do GEDCOM (0 HEAD).  Na 'Limpeza' essas linhas serão removidas.";
$pgv_lang["label_added_servers"]="Adicionar Servidores Remotos";
$pgv_lang["label_banned_servers"]="Banir sites por IP";
$pgv_lang["label_families"]="Familias";
$pgv_lang["label_gedcom_id2"]="ID do Banco de Dados:";
$pgv_lang["label_individuals"]="Individuos";
$pgv_lang["label_manual_search_engines"]="IPs de Robôs de Sites de Pesquisa";
$pgv_lang["label_new_server"]="Novo site";
$pgv_lang["label_password_id"]="Senha";
$pgv_lang["label_server_info"]="Todas as pessoas ligadas remotamente pelo site:";
$pgv_lang["label_server_url"]="Site URL/IP";
$pgv_lang["label_username_id"]="Membro";
$pgv_lang["label_view_local"]="Exibir dados locais da pessoa";
$pgv_lang["label_view_remote"]="Exibir dados remotos da pessoa";
$pgv_lang["LANG_SELECTION"]="Idiomas Disponíveis";
$pgv_lang["LANGUAGE_DEFAULT"]		= "Não houve configuração de idiomas para este site.<br />PhpGedView usará o padrão.";
$pgv_lang["last_login"]="Último acesso";
$pgv_lang["lasttab"]							= "Guia último visitado para individuais";
$pgv_lang["leave_blank"]="Deixe a senha em branco para manter a senha inalterada.";
$pgv_lang["link_manage_servers"]="Gerenciar os Sites";
$pgv_lang["logfile_content"]="Conteúdo do ficheiro de log";
$pgv_lang["macfile_detected"]="Detectado ficheiro Macintosh.  Na 'Limpeza' seu ficheiro será convertido para um ficheiro DOS.";
$pgv_lang["mailto"]="Somente E-Mail Externo";
$pgv_lang["merge_records"]="Consolidar Registos";
$pgv_lang["message_to_all"]						= "Enviar mensagem a todos os membros";
$pgv_lang["messaging"]="Somente E-Mail Interno";
$pgv_lang["messaging2"]="E-Mail Interno e Externo";
$pgv_lang["messaging3"]			= "PhpGedView envia e-mails sem armazena-los";
$pgv_lang["month_before_day"]="Mês antes do Dia (MM DD YYYY)";
$pgv_lang["monthly"]="Mensalmente";
$pgv_lang["msql"]="Mini SQL";
$pgv_lang["mssql"]="Microsoft SQL server";
$pgv_lang["mysql"]="MySQL";
$pgv_lang["never"]="Nunca";
$pgv_lang["no_logs"]			= "Desabilitar Diário (Log)";
$pgv_lang["no_messaging"]="Nenhum método de contato";
$pgv_lang["oci8"]="Oracle 7+";
$pgv_lang["page_views"]							= "&nbsp;&nbsp;visualizações de página em&nbsp;&nbsp;";
$pgv_lang["performing_validation"]="Validando o ficheiro GEDCOM...";
$pgv_lang["pgsql"]="PostgreSQL";
$pgv_lang["pgv_config_write_error"]				= "Erro!!! Não é possível gravar o ficheiro de configuração PhpGedView. Por favor, verifique as permissões de Ficheiros e diretórios e tente novamente.";
$pgv_lang["PGV_MEMORY_LIMIT"]		= "Limite de Memória Utilizada";
$pgv_lang["PGV_SESSION_SAVE_PATH"]				= "Diretório para salvar a sessão";
$pgv_lang["PGV_SESSION_TIME"]="Tempo máximo de uma sessão";
$pgv_lang["PGV_SIMPLE_MAIL"]					= "Utilizar cabeçalhos simples em e-mails externos";
$pgv_lang["PGV_SMTP_ACTIVE"]					= "Utilizar SMTP para enviar e-mails externos";
$pgv_lang["PGV_SMTP_HOST"]						= "Nome do servidor de saída (SMTP)";
$pgv_lang["PGV_SMTP_HELO"]						= "Nome do domínio de saída";
$pgv_lang["PGV_SMTP_PORT"]						= "Porta SMTP";
$pgv_lang["PGV_SMTP_AUTH"]						= "Utilizar o nome ea senha";
$pgv_lang["PGV_SMTP_AUTH_USER"]					= "Nome de membro";
$pgv_lang["PGV_SMTP_AUTH_PASS"]					= "Senha";
$pgv_lang["PGV_SMTP_SSL"]						= "Conexão segura";
$pgv_lang["PGV_SMTP_FROM_NAME"] 				= "Nome do remetente";
$pgv_lang["PGV_STORE_MESSAGES"]="Permitir armazenamento de mensagens no servidor";
$pgv_lang["phpinfo"]="Informações do PHP";
$pgv_lang["place_cleanup_detected"]="Detectado codificação inválida de Local.  Esses erros precisariam ser corrigidos. O exemplo seguinte mostra o local inválido que foi detectado: ";
$pgv_lang["please_be_patient"]="Por Favor, seja paciente !!!";
$pgv_lang["privileges"]="Privilégios";
$pgv_lang["reading_file"]="Lendo ficheiro GEDCOM";
$pgv_lang["readme_documentation"]="Documentação";
$pgv_lang["remove_ip"]="Excluir IP";
$pgv_lang["REQUIRE_ADMIN_AUTH_REGISTRATION"]="Registro dos novos membros deverão ser aprovados pelo administrador";
$pgv_lang["review_readme"]						= "Você deve analisar o ficheiro <a href=\"readme.txt\" target=\"_blank\">readme.txt</a> antes de continuar a configurar PhpGedView.<br /><br />";
$pgv_lang["seconds"]							= "&nbsp;&nbsp;segundo";
$pgv_lang["select_an_option"]="Escolha uma opção abaixo:";
$pgv_lang["SERVER_URL"]							= "URL PhpGedView";
$pgv_lang["show_phpinfo"]="Mostrar a página PHPInfo";
$pgv_lang["siteadmin"]="Admistrador do Site";
$pgv_lang["sqlite"]="SQLite";
$pgv_lang["sybase"]="Sybase";
$pgv_lang["sync_gedcom"]="Sincronizar os dados do Membro com os dados do Banco de Dados (GEDCOM)";
$pgv_lang["system_time"]						= "Hora do Servidor:";
$pgv_lang["user_time"]							= "Hora atual do membro:";
$pgv_lang["TBLPREFIX"]="Prefixo das Tabelas do Banco de Dados";
$pgv_lang["themecustomization"]					= "Personalização do tema";
$pgv_lang["time_limit"]="Limite de Tempo:";
$pgv_lang["title_manage_servers"]="Gerenciar Sites";
$pgv_lang["title_view_conns"]="Exibir Conexões";
$pgv_lang["translator_tools"]					= "Instrumentos de tradutor";
$pgv_lang["update_myaccount"]="Alterar Minha Conta";
$pgv_lang["update_user"]="Alterar Conta do Membro";
$pgv_lang["upload_gedcom"]						= "Enviar GEDCOM";
$pgv_lang["USE_REGISTRATION_MODULE"]			= "Permitir que os visitantes pedido de registro de conta";
$pgv_lang["user_auto_accept"]="Aceitar, imediatamente, as alterações feitas por este membro ";
$pgv_lang["user_contact_method"]="Método preferido de Contato";
$pgv_lang["user_create_error"]="Não foi possível criar o membro. Tente novamente.";
$pgv_lang["user_created"]="Membro criado com sucesso.";
$pgv_lang["user_default_tab"]="Ficha a ser exibida na página de dados de pessoas";
$pgv_lang["user_path_length"]					= "Comprimento máximo do caminho de privacidade relação";
$pgv_lang["user_relationship_priv"]="Restringir o acesso a pessoas relacionadas ao membro";
$pgv_lang["users_admin"]						= "Administradores do site";
$pgv_lang["users_gedadmin"]						= "Administradores de GEDCOM";
$pgv_lang["users_total"]						= "Número total de membros";
$pgv_lang["users_unver"]						= "Não confirmado pelo membro";
$pgv_lang["users_unver_admin"]					= "Não verificado pelo administrador";
$pgv_lang["usr_deleted"]						= "Membro que foi excluído: ";
$pgv_lang["usr_idle"]							= "Número de meses desde o último acesso para uma conta de membro para ser considerada inativa: ";
$pgv_lang["usr_idle_toolong"]					= "Conta do membro estiver inativo por muito tempo: ";
$pgv_lang["usr_no_cleanup"]						= "Nada foi encontrado para limpar";
$pgv_lang["usr_unset_gedcomid"]					= "Desativar GEDCOM ID para ";
$pgv_lang["usr_unset_rights"]					= "Eliminar os direitos GEDCOM para ";
$pgv_lang["usr_unset_rootid"]					= "Desativar identificação de raiz para ";
$pgv_lang["valid_gedcom"]="Detectado GEDCOM válido.  A limpeza não é necessária.";
$pgv_lang["validate_gedcom"]="Validar GEDCOM";
$pgv_lang["verified"]="Validou sua conta";
$pgv_lang["verified_by_admin"]="Aprovado pelo Administrador";
$pgv_lang["verify_gedcom"]="Checar GEDCOM";
$pgv_lang["verify_upload_instructions"]			= "Um ficheiro GEDCOM com este nome já existe. Se você escolher continuar, o ficheiro GEDCOM do servidor será substituído pelo GEDCOM que será enviado e o processo de importação terá inicio logo após. Para manter o ficheiro GEDCOM do servidor inalterado clique CANCELAR.";
$pgv_lang["view_changelog"]="Exibir o ficheiro changelog.txt";
$pgv_lang["view_logs"]="Exibir Logs";
$pgv_lang["view_readme"]="Leia o ficheiro readme.txt";
$pgv_lang["visibleonline"]="Visível para outros membros quando on-line";
$pgv_lang["visitor"]="Visitante";
$pgv_lang["warn_users"]							= "Membros com avisos";
$pgv_lang["weekly"]="Semanalmente";
$pgv_lang["welcome_new"]						= "Bem-vindo ao seu novo website PhpGedView.";
$pgv_lang["yearly"]="Anualmente";
$pgv_lang["admin_OK_subject"]					= "Aprovação da conta em #SERVER_NAME#";
$pgv_lang["admin_OK_message"]					= "O administrador no site PhpGedView #SERVER_NAME# tem aprovado o seu pedido para uma conta.\r\n\r\n Você pode agora efetuar login acedendo o seguinte link: #SERVER_NAME#";

$pgv_lang["batch_update"]="Executar atualizações/edições em lotes em seu GEDCOM";

// Text for the Gedcom Checker
$pgv_lang["gedcheck"]     = "Verificador Gedcom";          // Module title
$pgv_lang["gedcheck_text"]= "Este módulo verifica o formato de um ficheiro de GEDCOM contra o <a href=\"http://phpgedview.sourceforge.net/ged551-5.pdf\">especificação GEDCOM 5.5.1</a>.  Ele também verifica para um número de erros comuns em seus dados. Note-se que existem muitas versões, extensões e variações na especificação do modo que você não deve se preocupar com outras questões além das marcadas como \"crítica\".  A explicação para os erros de linha por linha pode ser encontrada na especificação, portanto, verifique lá antes de pedir ajuda.";
$pgv_lang["gedcheck_sync"] = "As edições feitas ao banco de dados não são sincronizadas com o ficheiro #GLOBALS[ged]#. O conteúdo do ficheiro pode estar desatualizado. Você pode sincronizar com o banco de dados agora realizando uma de <b><a \"#GLOBALS[ged_link]#\">export</a></b>.";
$pgv_lang["gedcheck_nothing"] = "Nenhum erro encontrado neste nível.";
$pgv_lang["level"]        = "Nível";                   // Levels of checking
$pgv_lang["critical"]     = "Crítica";
$pgv_lang["error"]        = "Erro";
$pgv_lang["warning"]      = "Aviso";
$pgv_lang["info"]         = "Informação";
$pgv_lang["open_link"]    = "Abrir links em";           // Where to open links
$pgv_lang["same_win"]     = "Mesma aba/janela";
$pgv_lang["new_win"]      = "Nova aba/janela";
$pgv_lang["context_lines"]= "Linhas de contexto GEDCOM"; // Number of lines either side of error
$pgv_lang["all_rec"]      = "Todos os registos";             // What to show
$pgv_lang["err_rec"]      = "Registos com erros";
$pgv_lang["missing"]      = "em falta";                 // General error messages
$pgv_lang["multiple"]     = "múltiplas";
$pgv_lang["invalid"]      = "inválido";
$pgv_lang["too_many"]     = "demais";
$pgv_lang["too_few"]      = "muito poucos";
$pgv_lang["no_link"]      = "não ligar de volta";
$pgv_lang["data"]         = "dados";                    // Specific errors (used with general errors)
$pgv_lang["see"]          = "ver";
$pgv_lang["noref"]        = "Nada referências este registro";
$pgv_lang["tag"]          = "tag";
$pgv_lang["spacing"]      = "espaçamento";
$pgv_lang["ADVANCED_NAME_FACTS"] = "Fatos avançada de nome";
$pgv_lang["ADVANCED_PLAC_FACTS"] = "Fatos avançada de nome do lugar";
$pgv_lang["SURNAME_TRADITION"]		= "Tradição apelido"; // Default surname inheritance
$pgv_lang["tradition_spanish"]		= "Espanhol";
$pgv_lang["tradition_portuguese"]	= "Português";
$pgv_lang["tradition_icelandic"]	= "Islandesa";
$pgv_lang["tradition_paternal"]		= "Paterno";
$pgv_lang["tradition_polish"]		= "Polaco";
$pgv_lang["tradition_none"]			= "Nenhum";

// -- The following text is used to build the phrase "i years, j months, k days, l hours, m minutes"
// -- for use in text such as "xxx ago" or "after xxx" or "in xxx"
$pgv_lang["elapsedYear1"]	=	"1 ano";
$pgv_lang["elapsedYear2"]	=	"#pgv_lang[global_num1]# anos";	// used in Polish for 2,3,4 or 22,23,24 or 32,33,34 etc.
$pgv_lang["elapsedYears"]	=	"#pgv_lang[global_num1]# anos";
$pgv_lang["elapsedMonth1"]	=	"1 mês";
$pgv_lang["elapsedMonth2"]	=	"#pgv_lang[global_num1]# meses";	// used in Polish for 2,3,4 or 22,23,24 or 32,33,34 etc.
$pgv_lang["elapsedMonths"]	=	"#pgv_lang[global_num1]# meses";
$pgv_lang["elapsedDay1"]	=	"1 dia";
$pgv_lang["elapsedDay2"]	=	"#pgv_lang[global_num1]# dias";		// used in Polish for 2,3,4 or 22,23,24 or 32,33,34 etc.
$pgv_lang["elapsedDays"]	=	"#pgv_lang[global_num1]# dias";
$pgv_lang["elapsedHour1"]	=	"1 hora";
$pgv_lang["elapsedHour2"]	=	"#pgv_lang[global_num1]# horas";	// used in Polish for 2,3,4 or 22,23,24 or 32,33,34 etc.
$pgv_lang["elapsedHours"]	=	"#pgv_lang[global_num1]# horas";
$pgv_lang["elapsedMinute1"]	=	"1 minuto";
$pgv_lang["elapsedMinute2"]	=	"#pgv_lang[global_num1]# minutos";	// used in Polish for 2,3,4 or 22,23,24 or 32,33,34 etc.
$pgv_lang["elapsedMinutes"]	=	"#pgv_lang[global_num1]# minutos";

$pgv_lang["elapsedAgo"]		=	"#pgv_lang[global_string1]# atrás";

?>
