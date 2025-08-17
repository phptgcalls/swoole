<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long id string title string slug int num Vector<StarGiftAttribute> attributes int availability_issued int availability_total true require_premium true resale_ton_only peer owner_id string owner_name string owner_address string gift_address Vector<StarsAmount> resell_amount peer released_by
 * @return StarGift
 */

final class StarGiftUnique extends Instance {
	public function request(int $id,string $title,string $slug,int $num,array $attributes,int $availability_issued,int $availability_total,? true $require_premium = null,? true $resale_ton_only = null,? object $owner_id = null,? string $owner_name = null,? string $owner_address = null,? string $gift_address = null,? array $resell_amount = null,? object $released_by = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x3a274d50);
		$flags = 0;
		$flags |= is_null($require_premium) ? 0 : (1 << 6);
		$flags |= is_null($resale_ton_only) ? 0 : (1 << 7);
		$flags |= is_null($owner_id) ? 0 : (1 << 0);
		$flags |= is_null($owner_name) ? 0 : (1 << 1);
		$flags |= is_null($owner_address) ? 0 : (1 << 2);
		$flags |= is_null($gift_address) ? 0 : (1 << 3);
		$flags |= is_null($resell_amount) ? 0 : (1 << 4);
		$flags |= is_null($released_by) ? 0 : (1 << 5);
		$writer->writeInt($flags);
		$writer->writeLong($id);
		$writer->tgwriteBytes($title);
		$writer->tgwriteBytes($slug);
		$writer->writeInt($num);
		if(is_null($owner_id) === false):
			$writer->write($owner_id->read());
		endif;
		if(is_null($owner_name) === false):
			$writer->tgwriteBytes($owner_name);
		endif;
		if(is_null($owner_address) === false):
			$writer->tgwriteBytes($owner_address);
		endif;
		$writer->tgwriteVector($attributes,'StarGiftAttribute');
		$writer->writeInt($availability_issued);
		$writer->writeInt($availability_total);
		if(is_null($gift_address) === false):
			$writer->tgwriteBytes($gift_address);
		endif;
		if(is_null($resell_amount) === false):
			$writer->tgwriteVector($resell_amount,'StarsAmount');
		endif;
		if(is_null($released_by) === false):
			$writer->write($released_by->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 6)):
			$result['require_premium'] = true;
		else:
			$result['require_premium'] = false;
		endif;
		if($flags & (1 << 7)):
			$result['resale_ton_only'] = true;
		else:
			$result['resale_ton_only'] = false;
		endif;
		$result['id'] = $reader->readLong();
		$result['title'] = $reader->tgreadBytes();
		$result['slug'] = $reader->tgreadBytes();
		$result['num'] = $reader->readInt();
		if($flags & (1 << 0)):
			$result['owner_id'] = $reader->tgreadObject();
		else:
			$result['owner_id'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['owner_name'] = $reader->tgreadBytes();
		else:
			$result['owner_name'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['owner_address'] = $reader->tgreadBytes();
		else:
			$result['owner_address'] = null;
		endif;
		$result['attributes'] = $reader->tgreadVector('StarGiftAttribute');
		$result['availability_issued'] = $reader->readInt();
		$result['availability_total'] = $reader->readInt();
		if($flags & (1 << 3)):
			$result['gift_address'] = $reader->tgreadBytes();
		else:
			$result['gift_address'] = null;
		endif;
		if($flags & (1 << 4)):
			$result['resell_amount'] = $reader->tgreadVector('StarsAmount');
		else:
			$result['resell_amount'] = null;
		endif;
		if($flags & (1 << 5)):
			$result['released_by'] = $reader->tgreadObject();
		else:
			$result['released_by'] = null;
		endif;
		return new self($result);
	}
}

?>