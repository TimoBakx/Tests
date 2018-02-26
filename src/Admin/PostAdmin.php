<?php
declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ChoiceFieldMaskType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sonata\AdminBundle\Admin\AdminInterface;
use Knp\Menu\ItemInterface as MenuItemInterface;


/**
 * Class PostAdmin
 *
 * @package App\Admin
 */
class PostAdmin extends AbstractAdmin
{
    /**
     * @param string $code
     * @param string $class
     * @param string $baseControllerName
     */
    public function __construct(string $code, string $class, string $baseControllerName)
    {
        parent::__construct($code, $class, $baseControllerName);

        $this->datagridValues = [
            '_page' => 1,
            '_per_page' => 10,
            '_sort_order' => 'ASC',
            '_sort_by' => 'title',
        ];
        $this->perPageOptions = ['10', '25', '50', '100'];
    }

    /**
	 * @param FormMapper $formMapper
	 *
	 * @return void
	 */
	protected function configureFormFields(FormMapper $formMapper): void
	{
		$formMapper
			->add('title', TextType::class)
            ->add('published', ChoiceFieldMaskType::class, [
                'label' => 'Active?',
                'choices' => ['No' => 0, 'Yes' => 1],
                'expanded' => true,
                'required' => true,
                'attr' => [
                    'class' => 'list-inline'
                ],
                'map' => [
                    1 => ['relatedPosts'],
                    0 => [],
                ]
            ])
			->add('relatedPosts', ModelType::class, [
				'by_reference' => false,
				'expanded' => false,
				'multiple' => true,
				'choice_translation_domain' => false,
			]);
	}

	/**
	 * @param DatagridMapper $datagridMapper
	 *
	 * @return void
	 * @throws \RuntimeException
	 */
	protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
	{
		$datagridMapper->add('title', null,
			['global_search' => false]
		);
	}

	/**
	 * @param ListMapper $listMapper
	 *
	 * @return void
	 */
	protected function configureListFields(ListMapper $listMapper): void
	{
		$listMapper->addIdentifier('title');
	}
}