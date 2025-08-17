<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int date stargift gift true name_hidden true unsaved true refunded true can_upgrade true pinned_to_top peer from_id textwithentities message int msg_id long saved_id long convert_stars long upgrade_stars int can_export_at long transfer_stars int can_transfer_at int can_resell_at Vector<int> collection_id
 * @return SavedStarGift
 */

final class SavedStarGift extends Instance {
	public function request(int $date,object $gift,? true $name_hidden = null,? true $unsaved = null,? true $refunded = null,? true $can_upgrade = null,? true $pinned_to_top = null,? object $from_id = null,? object $message = null,? int $msg_id = null,? int $saved_id = null,? int $convert_stars = null,? int $upgrade_stars = null,? int $can_export_at = null,? int $transfer_stars = null,? int $can_transfer_at = null,? int $can_resell_at = null,? array $collection_id = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x1ea646df);
		$flags = 0;
		$flags |= is_null($name_hidden) ? 0 : (1 << 0);
		$flags |= is_null($unsaved) ? 0 : (1 << 5);
		$flags |= is_null($refunded) ? 0 : (1 << 9);
		$flags |= is_null($can_upgrade) ? 0 : (1 << 10);
		$flags |= is_null($pinned_to_top) ? 0 : (1 << 12);
		$flags |= is_null($from_id) ? 0 : (1 << 1);
		$flags |= is_null($message) ? 0 : (1 << 2);
		$flags |= is_null($msg_id) ? 0 : (1 << 3);
		$flags |= is_null($saved_id) ? 0 : (1 << 11);
		$flags |= is_null($convert_stars) ? 0 : (1 << 4);
		$flags |= is_null($upgrade_stars) ? 0 : (1 << 6);
		$flags |= is_null($can_export_at) ? 0 : (1 << 7);
		$flags |= is_null($transfer_stars) ? 0 : (1 << 8);
		$flags |= is_null($can_transfer_at) ? 0 : (1 << 13);
		$flags |= is_null($can_resell_at) ? 0 : (1 << 14);
		$flags |= is_null($collection_id) ? 0 : (1 << 15);
		$writer->writeInt($flags);
		if(is_null($from_id) === false):
			$writer->write($from_id->read());
		endif;
		$writer->writeInt($date);
		$writer->write($gift->read());
		if(is_null($message) === false):
			$writer->write($message->read());
		endif;
		if(is_null($msg_id) === false):
			$writer->writeInt($msg_id);
		endif;
		if(is_null($saved_id) === false):
			$writer->writeLong($saved_id);
		endif;
		if(is_null($convert_stars) === false):
			$writer->writeLong($convert_stars);
		endif;
		if(is_null($upgrade_stars) === false):
			$writer->writeLong($upgrade_stars);
		endif;
		if(is_null($can_export_at) === false):
			$writer->writeInt($can_export_at);
		endif;
		if(is_null($transfer_stars) === false):
			$writer->writeLong($transfer_stars);
		endif;
		if(is_null($can_transfer_at) === false):
			$writer->writeInt($can_transfer_at);
		endif;
		if(is_null($can_resell_at) === false):
			$writer->writeInt($can_resell_at);
		endif;
		if(is_null($collection_id) === false):
			$writer->tgwriteVector($collection_id,'int');
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
		if($flags & (1 << 5)):
			$result['unsaved'] = true;
		else:
			$result['unsaved'] = false;
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
		if($flags & (1 << 12)):
			$result['pinned_to_top'] = true;
		else:
			$result['pinned_to_top'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['from_id'] = $reader->tgreadObject();
		else:
			$result['from_id'] = null;
		endif;
		$result['date'] = $reader->readInt();
		$result['gift'] = $reader->tgreadObject();
		if($flags & (1 << 2)):
			$result['message'] = $reader->tgreadObject();
		else:
			$result['message'] = null;
		endif;
		if($flags & (1 << 3)):
			$result['msg_id'] = $reader->readInt();
		else:
			$result['msg_id'] = null;
		endif;
		if($flags & (1 << 11)):
			$result['saved_id'] = $reader->readLong();
		else:
			$result['saved_id'] = null;
		endif;
		if($flags & (1 << 4)):
			$result['convert_stars'] = $reader->readLong();
		else:
			$result['convert_stars'] = null;
		endif;
		if($flags & (1 << 6)):
			$result['upgrade_stars'] = $reader->readLong();
		else:
			$result['upgrade_stars'] = null;
		endif;
		if($flags & (1 << 7)):
			$result['can_export_at'] = $reader->readInt();
		else:
			$result['can_export_at'] = null;
		endif;
		if($flags & (1 << 8)):
			$result['transfer_stars'] = $reader->readLong();
		else:
			$result['transfer_stars'] = null;
		endif;
		if($flags & (1 << 13)):
			$result['can_transfer_at'] = $reader->readInt();
		else:
			$result['can_transfer_at'] = null;
		endif;
		if($flags & (1 << 14)):
			$result['can_resell_at'] = $reader->readInt();
		else:
			$result['can_resell_at'] = null;
		endif;
		if($flags & (1 << 15)):
			$result['collection_id'] = $reader->tgreadVector('int');
		else:
			$result['collection_id'] = null;
		endif;
		return new self($result);
	}
}

?>