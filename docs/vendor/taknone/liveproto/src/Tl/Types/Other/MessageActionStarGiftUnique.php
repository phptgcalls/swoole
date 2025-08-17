<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param stargift gift true upgrade true transferred true saved true refunded int can_export_at long transfer_stars peer from_id peer peer long saved_id starsamount resale_amount int can_transfer_at int can_resell_at
 * @return MessageAction
 */

final class MessageActionStarGiftUnique extends Instance {
	public function request(object $gift,? true $upgrade = null,? true $transferred = null,? true $saved = null,? true $refunded = null,? int $can_export_at = null,? int $transfer_stars = null,? object $from_id = null,? object $peer = null,? int $saved_id = null,? object $resale_amount = null,? int $can_transfer_at = null,? int $can_resell_at = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x34f762f3);
		$flags = 0;
		$flags |= is_null($upgrade) ? 0 : (1 << 0);
		$flags |= is_null($transferred) ? 0 : (1 << 1);
		$flags |= is_null($saved) ? 0 : (1 << 2);
		$flags |= is_null($refunded) ? 0 : (1 << 5);
		$flags |= is_null($can_export_at) ? 0 : (1 << 3);
		$flags |= is_null($transfer_stars) ? 0 : (1 << 4);
		$flags |= is_null($from_id) ? 0 : (1 << 6);
		$flags |= is_null($peer) ? 0 : (1 << 7);
		$flags |= is_null($saved_id) ? 0 : (1 << 7);
		$flags |= is_null($resale_amount) ? 0 : (1 << 8);
		$flags |= is_null($can_transfer_at) ? 0 : (1 << 9);
		$flags |= is_null($can_resell_at) ? 0 : (1 << 10);
		$writer->writeInt($flags);
		$writer->write($gift->read());
		if(is_null($can_export_at) === false):
			$writer->writeInt($can_export_at);
		endif;
		if(is_null($transfer_stars) === false):
			$writer->writeLong($transfer_stars);
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
		if(is_null($resale_amount) === false):
			$writer->write($resale_amount->read());
		endif;
		if(is_null($can_transfer_at) === false):
			$writer->writeInt($can_transfer_at);
		endif;
		if(is_null($can_resell_at) === false):
			$writer->writeInt($can_resell_at);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['upgrade'] = true;
		else:
			$result['upgrade'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['transferred'] = true;
		else:
			$result['transferred'] = false;
		endif;
		if($flags & (1 << 2)):
			$result['saved'] = true;
		else:
			$result['saved'] = false;
		endif;
		if($flags & (1 << 5)):
			$result['refunded'] = true;
		else:
			$result['refunded'] = false;
		endif;
		$result['gift'] = $reader->tgreadObject();
		if($flags & (1 << 3)):
			$result['can_export_at'] = $reader->readInt();
		else:
			$result['can_export_at'] = null;
		endif;
		if($flags & (1 << 4)):
			$result['transfer_stars'] = $reader->readLong();
		else:
			$result['transfer_stars'] = null;
		endif;
		if($flags & (1 << 6)):
			$result['from_id'] = $reader->tgreadObject();
		else:
			$result['from_id'] = null;
		endif;
		if($flags & (1 << 7)):
			$result['peer'] = $reader->tgreadObject();
		else:
			$result['peer'] = null;
		endif;
		if($flags & (1 << 7)):
			$result['saved_id'] = $reader->readLong();
		else:
			$result['saved_id'] = null;
		endif;
		if($flags & (1 << 8)):
			$result['resale_amount'] = $reader->tgreadObject();
		else:
			$result['resale_amount'] = null;
		endif;
		if($flags & (1 << 9)):
			$result['can_transfer_at'] = $reader->readInt();
		else:
			$result['can_transfer_at'] = null;
		endif;
		if($flags & (1 << 10)):
			$result['can_resell_at'] = $reader->readInt();
		else:
			$result['can_resell_at'] = null;
		endif;
		return new self($result);
	}
}

?>