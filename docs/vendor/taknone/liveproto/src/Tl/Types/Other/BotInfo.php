<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param true has_preview_medias long user_id string description photo description_photo document description_document Vector<BotCommand> commands botmenubutton menu_button string privacy_policy_url botappsettings app_settings botverifiersettings verifier_settings
 * @return BotInfo
 */

final class BotInfo extends Instance {
	public function request(? true $has_preview_medias = null,? int $user_id = null,? string $description = null,? object $description_photo = null,? object $description_document = null,? array $commands = null,? object $menu_button = null,? string $privacy_policy_url = null,? object $app_settings = null,? object $verifier_settings = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x4d8a0299);
		$flags = 0;
		$flags |= is_null($has_preview_medias) ? 0 : (1 << 6);
		$flags |= is_null($user_id) ? 0 : (1 << 0);
		$flags |= is_null($description) ? 0 : (1 << 1);
		$flags |= is_null($description_photo) ? 0 : (1 << 4);
		$flags |= is_null($description_document) ? 0 : (1 << 5);
		$flags |= is_null($commands) ? 0 : (1 << 2);
		$flags |= is_null($menu_button) ? 0 : (1 << 3);
		$flags |= is_null($privacy_policy_url) ? 0 : (1 << 7);
		$flags |= is_null($app_settings) ? 0 : (1 << 8);
		$flags |= is_null($verifier_settings) ? 0 : (1 << 9);
		$writer->writeInt($flags);
		if(is_null($user_id) === false):
			$writer->writeLong($user_id);
		endif;
		if(is_null($description) === false):
			$writer->tgwriteBytes($description);
		endif;
		if(is_null($description_photo) === false):
			$writer->write($description_photo->read());
		endif;
		if(is_null($description_document) === false):
			$writer->write($description_document->read());
		endif;
		if(is_null($commands) === false):
			$writer->tgwriteVector($commands,'BotCommand');
		endif;
		if(is_null($menu_button) === false):
			$writer->write($menu_button->read());
		endif;
		if(is_null($privacy_policy_url) === false):
			$writer->tgwriteBytes($privacy_policy_url);
		endif;
		if(is_null($app_settings) === false):
			$writer->write($app_settings->read());
		endif;
		if(is_null($verifier_settings) === false):
			$writer->write($verifier_settings->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 6)):
			$result['has_preview_medias'] = true;
		else:
			$result['has_preview_medias'] = false;
		endif;
		if($flags & (1 << 0)):
			$result['user_id'] = $reader->readLong();
		else:
			$result['user_id'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['description'] = $reader->tgreadBytes();
		else:
			$result['description'] = null;
		endif;
		if($flags & (1 << 4)):
			$result['description_photo'] = $reader->tgreadObject();
		else:
			$result['description_photo'] = null;
		endif;
		if($flags & (1 << 5)):
			$result['description_document'] = $reader->tgreadObject();
		else:
			$result['description_document'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['commands'] = $reader->tgreadVector('BotCommand');
		else:
			$result['commands'] = null;
		endif;
		if($flags & (1 << 3)):
			$result['menu_button'] = $reader->tgreadObject();
		else:
			$result['menu_button'] = null;
		endif;
		if($flags & (1 << 7)):
			$result['privacy_policy_url'] = $reader->tgreadBytes();
		else:
			$result['privacy_policy_url'] = null;
		endif;
		if($flags & (1 << 8)):
			$result['app_settings'] = $reader->tgreadObject();
		else:
			$result['app_settings'] = null;
		endif;
		if($flags & (1 << 9)):
			$result['verifier_settings'] = $reader->tgreadObject();
		else:
			$result['verifier_settings'] = null;
		endif;
		return new self($result);
	}
}

?>