<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long id document sticker long stars long convert_stars true limited true sold_out true birthday true require_premium true limited_per_user int availability_remains int availability_total long availability_resale int first_sale_date int last_sale_date long upgrade_stars long resell_min_stars string title peer released_by int per_user_total int per_user_remains
 * @return StarGift
 */

final class StarGift extends Instance {
	public function request(int $id,object $sticker,int $stars,int $convert_stars,? true $limited = null,? true $sold_out = null,? true $birthday = null,? true $require_premium = null,? true $limited_per_user = null,? int $availability_remains = null,? int $availability_total = null,? int $availability_resale = null,? int $first_sale_date = null,? int $last_sale_date = null,? int $upgrade_stars = null,? int $resell_min_stars = null,? string $title = null,? object $released_by = null,? int $per_user_total = null,? int $per_user_remains = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xbcff5b);
		$flags = 0;
		$flags |= is_null($limited) ? 0 : (1 << 0);
		$flags |= is_null($sold_out) ? 0 : (1 << 1);
		$flags |= is_null($birthday) ? 0 : (1 << 2);
		$flags |= is_null($require_premium) ? 0 : (1 << 7);
		$flags |= is_null($limited_per_user) ? 0 : (1 << 8);
		$flags |= is_null($availability_remains) ? 0 : (1 << 0);
		$flags |= is_null($availability_total) ? 0 : (1 << 0);
		$flags |= is_null($availability_resale) ? 0 : (1 << 4);
		$flags |= is_null($first_sale_date) ? 0 : (1 << 1);
		$flags |= is_null($last_sale_date) ? 0 : (1 << 1);
		$flags |= is_null($upgrade_stars) ? 0 : (1 << 3);
		$flags |= is_null($resell_min_stars) ? 0 : (1 << 4);
		$flags |= is_null($title) ? 0 : (1 << 5);
		$flags |= is_null($released_by) ? 0 : (1 << 6);
		$flags |= is_null($per_user_total) ? 0 : (1 << 8);
		$flags |= is_null($per_user_remains) ? 0 : (1 << 8);
		$writer->writeInt($flags);
		$writer->writeLong($id);
		$writer->write($sticker->read());
		$writer->writeLong($stars);
		if(is_null($availability_remains) === false):
			$writer->writeInt($availability_remains);
		endif;
		if(is_null($availability_total) === false):
			$writer->writeInt($availability_total);
		endif;
		if(is_null($availability_resale) === false):
			$writer->writeLong($availability_resale);
		endif;
		$writer->writeLong($convert_stars);
		if(is_null($first_sale_date) === false):
			$writer->writeInt($first_sale_date);
		endif;
		if(is_null($last_sale_date) === false):
			$writer->writeInt($last_sale_date);
		endif;
		if(is_null($upgrade_stars) === false):
			$writer->writeLong($upgrade_stars);
		endif;
		if(is_null($resell_min_stars) === false):
			$writer->writeLong($resell_min_stars);
		endif;
		if(is_null($title) === false):
			$writer->tgwriteBytes($title);
		endif;
		if(is_null($released_by) === false):
			$writer->write($released_by->read());
		endif;
		if(is_null($per_user_total) === false):
			$writer->writeInt($per_user_total);
		endif;
		if(is_null($per_user_remains) === false):
			$writer->writeInt($per_user_remains);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['limited'] = true;
		else:
			$result['limited'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['sold_out'] = true;
		else:
			$result['sold_out'] = false;
		endif;
		if($flags & (1 << 2)):
			$result['birthday'] = true;
		else:
			$result['birthday'] = false;
		endif;
		if($flags & (1 << 7)):
			$result['require_premium'] = true;
		else:
			$result['require_premium'] = false;
		endif;
		if($flags & (1 << 8)):
			$result['limited_per_user'] = true;
		else:
			$result['limited_per_user'] = false;
		endif;
		$result['id'] = $reader->readLong();
		$result['sticker'] = $reader->tgreadObject();
		$result['stars'] = $reader->readLong();
		if($flags & (1 << 0)):
			$result['availability_remains'] = $reader->readInt();
		else:
			$result['availability_remains'] = null;
		endif;
		if($flags & (1 << 0)):
			$result['availability_total'] = $reader->readInt();
		else:
			$result['availability_total'] = null;
		endif;
		if($flags & (1 << 4)):
			$result['availability_resale'] = $reader->readLong();
		else:
			$result['availability_resale'] = null;
		endif;
		$result['convert_stars'] = $reader->readLong();
		if($flags & (1 << 1)):
			$result['first_sale_date'] = $reader->readInt();
		else:
			$result['first_sale_date'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['last_sale_date'] = $reader->readInt();
		else:
			$result['last_sale_date'] = null;
		endif;
		if($flags & (1 << 3)):
			$result['upgrade_stars'] = $reader->readLong();
		else:
			$result['upgrade_stars'] = null;
		endif;
		if($flags & (1 << 4)):
			$result['resell_min_stars'] = $reader->readLong();
		else:
			$result['resell_min_stars'] = null;
		endif;
		if($flags & (1 << 5)):
			$result['title'] = $reader->tgreadBytes();
		else:
			$result['title'] = null;
		endif;
		if($flags & (1 << 6)):
			$result['released_by'] = $reader->tgreadObject();
		else:
			$result['released_by'] = null;
		endif;
		if($flags & (1 << 8)):
			$result['per_user_total'] = $reader->readInt();
		else:
			$result['per_user_total'] = null;
		endif;
		if($flags & (1 << 8)):
			$result['per_user_remains'] = $reader->readInt();
		else:
			$result['per_user_remains'] = null;
		endif;
		return new self($result);
	}
}

?>