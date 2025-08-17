<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param bool show_previews bool silent int mute_until notificationsound sound bool stories_muted bool stories_hide_sender notificationsound stories_sound
 * @return InputPeerNotifySettings
 */

final class InputPeerNotifySettings extends Instance {
	public function request(? bool $show_previews = null,? bool $silent = null,? int $mute_until = null,? object $sound = null,? bool $stories_muted = null,? bool $stories_hide_sender = null,? object $stories_sound = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xcacb6ae2);
		$flags = 0;
		$flags |= is_null($show_previews) ? 0 : (1 << 0);
		$flags |= is_null($silent) ? 0 : (1 << 1);
		$flags |= is_null($mute_until) ? 0 : (1 << 2);
		$flags |= is_null($sound) ? 0 : (1 << 3);
		$flags |= is_null($stories_muted) ? 0 : (1 << 6);
		$flags |= is_null($stories_hide_sender) ? 0 : (1 << 7);
		$flags |= is_null($stories_sound) ? 0 : (1 << 8);
		$writer->writeInt($flags);
		if(is_null($show_previews) === false):
			$writer->tgwriteBool($show_previews);
		endif;
		if(is_null($silent) === false):
			$writer->tgwriteBool($silent);
		endif;
		if(is_null($mute_until) === false):
			$writer->writeInt($mute_until);
		endif;
		if(is_null($sound) === false):
			$writer->write($sound->read());
		endif;
		if(is_null($stories_muted) === false):
			$writer->tgwriteBool($stories_muted);
		endif;
		if(is_null($stories_hide_sender) === false):
			$writer->tgwriteBool($stories_hide_sender);
		endif;
		if(is_null($stories_sound) === false):
			$writer->write($stories_sound->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['show_previews'] = $reader->tgreadBool();
		else:
			$result['show_previews'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['silent'] = $reader->tgreadBool();
		else:
			$result['silent'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['mute_until'] = $reader->readInt();
		else:
			$result['mute_until'] = null;
		endif;
		if($flags & (1 << 3)):
			$result['sound'] = $reader->tgreadObject();
		else:
			$result['sound'] = null;
		endif;
		if($flags & (1 << 6)):
			$result['stories_muted'] = $reader->tgreadBool();
		else:
			$result['stories_muted'] = null;
		endif;
		if($flags & (1 << 7)):
			$result['stories_hide_sender'] = $reader->tgreadBool();
		else:
			$result['stories_hide_sender'] = null;
		endif;
		if($flags & (1 << 8)):
			$result['stories_sound'] = $reader->tgreadObject();
		else:
			$result['stories_sound'] = null;
		endif;
		return new self($result);
	}
}

?>