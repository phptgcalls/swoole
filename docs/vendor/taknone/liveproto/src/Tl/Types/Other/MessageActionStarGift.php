<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param stargift gift true name_hidden true saved true converted true upgraded true refunded true can_upgrade textwithentities message long convert_stars int upgrade_msg_id long upgrade_stars peer from_id peer peer long saved_id
 * @return MessageAction
 */

final class MessageActionStarGift extends Instance {
	public function request(object $gift,? true $name_hidden = null,? true $saved = null,? true $converted = null,? true $upgraded = null,? true $refunded = null,? true $can_upgrade = null,? object $message = null,? int $convert_stars = null,? int $upgrade_msg_id = null,? int $upgrade_stars = null,? object $from_id = null,? object $peer = null,? int $saved_id = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x4717e8a4);
		$flags = 0;
		$flags |= is_null($name_hidden) ? 0 : (1 << 0);
		$flags |= is_null($saved) ? 0 : (1 << 2);
		$flags |= is_null($converted) ? 0 : (1 << 3);
		$flags |= is_null($upgraded) ? 0 : (1 << 5);
		$flags |= is_null($refunded) ? 0 : (1 << 9);
		$flags |= is_null($can_upgrade) ? 0 : (1 << 10);
		$flags |= is_null($message) ? 0 : (1 << 1);
		$flags |= is_null($convert_stars) ? 0 : (1 << 4);
		$flags |= is_null($upgrade_msg_id) ? 0 : (1 << 5);
		$flags |= is_null($upgrade_stars) ? 0 : (1 << 8);
		$flags |= is_null($from_id) ? 0 : (1 << 11);
		$flags |= is_null($peer) ? 0 : (1 << 12);
		$flags |= is_null($saved_id) ? 0 : (1 << 12);
		$writer->writeInt($flags);
		$writer->write($gift->read());
		if(is_null($message) === false):
			$writer->write($message->read());
		endif;
		if(is_null($convert_stars) === false):
			$writer->writeLong($convert_stars);
		endif;
		if(is_null($upgrade_msg_id) === false):
			$writer->writeInt($upgrade_msg_id);
		endif;
		if(is_null($upgrade_stars) === false):
			$writer->writeLong($upgrade_stars);
		endif;
		if(is_null($from_id) === false):
			$writer->write($from_id->read());
		endif;
		if(is_null($peer) === false):
			$writer->write($peer->read());
		endif;
		if(is_null($saved_id) === false):
			$writer->writeLong($saved_id);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['name_hidden'] = true;
		else:
			$result['name_hidden'] = false;
		endif;
		if($flags & (1 << 2)):
			$result['saved'] = true;
		else:
			$result['saved'] = false;
		endif;
		if($flags & (1 << 3)):
			$result['converted'] = true;
		else:
			$result['converted'] = false;
		endif;
		if($flags & (1 << 5)):
			$result['upgraded'] = true;
		else:
			$result['upgraded'] = false;
		endif;
		if($flags & (1 << 9)):
			$result['refunded'] = true;
		else:
			$result['refunded'] = false;
		endif;
		if($flags & (1 << 10)):
			$result['can_upgrade'] = true;
		else:
			$result['can_upgrade'] = false;
		endif;
		$result['gift'] = $reader->tgreadObject();
		if($flags & (1 << 1)):
			$result['message'] = $reader->tgreadObject();
		else:
			$result['message'] = null;
		endif;
		if($flags & (1 << 4)):
			$result['convert_stars'] = $reader->readLong();
		else:
			$result['convert_stars'] = null;
		endif;
		if($flags & (1 << 5)):
			$result['upgrade_msg_id'] = $reader->readInt();
		else:
			$result['upgrade_msg_id'] = null;
		endif;
		if($flags & (1 << 8)):
			$result['upgrade_stars'] = $reader->readLong();
		else:
			$result['upgrade_stars'] = null;
		endif;
		if($flags & (1 << 11)):
			$result['from_id'] = $reader->tgreadObject();
		else:
			$result['from_id'] = null;
		endif;
		if($flags & (1 << 12)):
			$result['peer'] = $reader->tgreadObject();
		else:
			$result['peer'] = null;
		endif;
		if($flags & (1 << 12)):
			$result['saved_id'] = $reader->readLong();
		else:
			$result['saved_id'] = null;
		endif;
		return new self($result);
	}
}

?>